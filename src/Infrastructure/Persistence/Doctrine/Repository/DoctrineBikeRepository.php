<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Bike;
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
}