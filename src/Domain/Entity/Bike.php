<?php

declare(strict_types = 1);

namespace App\Domain\Entity;

use DateTime;

class Bike 
{
    private int $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct( 
        private string $name, 
        private string $trademark, 
        private string $model, 
        private float $price
    ) {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

     public function id(): int
    {
        return $this->id;
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

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setTrademark(string $trademark): void
    {
        $this->trademark = $trademark;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "trademark" => $this->trademark,
            "model" => $this->model,
            "price" => $this->price,
        ];
    }

}
