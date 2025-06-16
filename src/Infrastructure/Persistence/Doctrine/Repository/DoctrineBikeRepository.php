<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Bike;
use App\Domain\Exception\EntityNotFoundException;
use App\Domain\Repository\BikeRepository;
use Doctrine\ORM\EntityRepository;

final class DoctrineBikeRepository extends EntityRepository implements BikeRepository
{
    public function save(Bike $bike): void
    {
        $bike->setUpdatedAt();
        $this->getEntityManager()->persist($bike);
        $this->getEntityManager()->flush();
    }

    public function getBikeById(int $bikeId): ?Bike
    {
        $bike = $this->findById($bikeId);
        if (!$bike) {
            throw new EntityNotFoundException(self::class, $bikeId);
        }

        return $bike;
    }

    public function findById(int $bikeId): ?Bike
    {
        return $this->findOneBy(['id' => $bikeId]);
    }


    public function getBikes(): array
    {
        return parent::findAll(Bike::class);
    }
}