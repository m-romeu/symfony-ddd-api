<?php
declare(strict_types=1);

namespace App\Application\Command;

final class CreateBikeCommand
{
    public function __construct(
        private readonly string $name,
        private readonly string $trademark,
        private readonly string $model,
        private readonly float $price
    ) {

    }

    public function name(): string
    {
        return $this->name;
    }

    public function trademark(): string
    {
        return $this->trademark;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function price(): float
    {
        return $this->price;
    }
}