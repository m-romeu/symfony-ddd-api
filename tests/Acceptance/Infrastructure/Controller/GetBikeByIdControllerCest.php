<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Infrastructure\Controller;

use App\Infrastructure\Persistence\Doctrine\DataFixtures\BikeFixtures;
use App\Tests\Support\AcceptanceTester;
use Codeception\Util\HttpCode;

final class GetBikeByIdControllerCest
{
    private const ENDPOINT_URL = '/bikes/{bikeId}';

    public function testGetBikeById(AcceptanceTester $I): void
    {
        $feature = 'Given a valid request with an id ' .
            'Then I should receive a successful response with the bike retrieved';
        $I->wantTo($feature);

        $bikeId = BikeFixtures::FIXTURE_BIKE_ID;

        $url = str_replace('{bikeId}',(string) $bikeId, self::ENDPOINT_URL);
        
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->sendGET($url);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains(BikeFixtures::FIXTURE_BIKE_NAME, $response);
    }
}
