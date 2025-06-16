<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Entity;

use App\Domain\Entity\Bike;
use App\Tests\Support\UnitTester;

class BikeTest extends \Codeception\Test\Unit
{
    public const BIKE_NAME = "bicicleta Trek";
    public const BIKE_TRADEMARK = "Trek";
    public const BIKE_MODEL = "8000 WSD";
    public const BIKE_PRICE = 1300.00;

    protected UnitTester $tester;

    protected function _before(): void
    {
    }

    public function testCreateBike(): void
    {
       $bike = new Bike(
            self::BIKE_NAME,
            self::BIKE_TRADEMARK,
            self::BIKE_MODEL,
            self::BIKE_PRICE
       );

        $this->assertNotNull($bike->createdAt());
        $this->assertNotNull($bike->updatedAt());
        $this->assertInstanceOf(Bike::class, $bike);
    }
   
}
