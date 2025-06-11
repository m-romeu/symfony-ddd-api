<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command\CreateBikeCommand;
use App\DOmain\Entity\Bike;
use App\Domain\Repository\BikeRepository;

final class CreateBikeCommandHandler
{
    public function __construct(private BikeRepository $bikeRepository)
    {

    }

    public function __invoke(CreateBikeCommand $createBikeCommand): int
    {
        $bike = new Bike(
            $createBikeCommand->name(),
            $createBikeCommand->trademark(),
            $createBikeCommand->model(),
            $createBikeCommand->price()
        );

        $this->bikeRepository->save($bike);
        return $bike->id();
    }
}