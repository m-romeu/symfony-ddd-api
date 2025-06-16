<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Bike;

interface BikeRepository
{
    public function save(Bike $bike): void;

    public function getBikeById(int $bikeId): ?Bike;

    public function getBikes(): array;
}