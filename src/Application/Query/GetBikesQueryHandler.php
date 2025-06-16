<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Repository\BikeRepository;

class GetBikesQueryHandler
{
    public function __construct(
        private readonly BikeRepository $bikeRepository
    ) {
    }
  
    public function __invoke(): array
    {
        $bikes = $this->bikeRepository->getBikes();

        $bikeList = [];

        foreach ($bikes as $bike) {
            $bikeList[] = $bike->toArray();
        }

        return $bikeList;
    }
}


