<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\DataFixtures;

use App\Domain\Entity\Bike;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BikeFixtures extends Fixture
{
    public const FIXTURE_BIKE_ID = 1;
    public const FIXTURE_BIKE_NAME = "bicicleta Orbea Alma";
    public const FIXTURE_BIKE_TRADEMARK = "Orbea";
    public const FIXTURE_BIKE_MODEL = "Alma";
    public const FIXTURE_BIKE_PRICE = 1200.00;

    public function load(ObjectManager $manager): void
    {
        $this->loadBikes($manager);
    }

    private function loadBikes(ObjectManager $manager): void
    {
        $bike = new Bike(
                self::FIXTURE_BIKE_NAME,
                self::FIXTURE_BIKE_TRADEMARK,
                self::FIXTURE_BIKE_MODEL,
                self::FIXTURE_BIKE_PRICE
        );

        $manager->persist($bike);
        $manager->flush();
    }
}
