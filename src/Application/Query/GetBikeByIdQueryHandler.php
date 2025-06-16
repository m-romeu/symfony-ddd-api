<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Entity\Bike;
use App\Domain\Repository\BikeRepository;

class GetBikeByIdQueryHandler
{
    public function __construct(
        private readonly BikeRepository $bikeRepository
    ) {
    }
  
    public function __invoke(GetBikeByIdQuery $query): array
    {
        $bike = $this->bikeRepository->getBikeById($query->id());

        return $bike->toArray();
    }
}


