<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Command\UpdateBikeCommand;
use App\Domain\Repository\BikeRepository;

final class UpdateBikeCommandHandler
{
    public function __construct(private readonly BikeRepository $bikeRepository)
    {

    }

    public function __invoke(UpdateBikeCommand $updateBikeCommand): array
    {
        $bike = $this->bikeRepository->getBikeById($updateBikeCommand->id());

        $bike->setName($updateBikeCommand->name());
        $bike->setTrademark($updateBikeCommand->trademark());
        $bike->setModel($updateBikeCommand->model());
        $bike->setPrice($updateBikeCommand->price());

        $this->bikeRepository->save($bike);
        return $bike->toArray();
    }
}