<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Infrastructure\Controller;

use App\Tests\Support\AcceptanceTester;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Codeception\Util\HttpCode;

final class CreateBikeControllerCest
{
    private const ENDPOINT_URL = '/bikes';

    public function testCreateBike(AcceptanceTester $I): void
    {
        $feature = 'Given a valid request ' .
            'Then I should receive a successful response with the bike id created';
        $I->wantTo($feature);

        $body = json_encode(
            [
                "name" => "bike 1",
                "trademark" => "trek",
                "model" => "800 WSD",
                "price" => 1000.00
            ]
        );
        
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, $body);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeRequestIsValid($I->getSpecPath(self::ENDPOINT_URL), Request::METHOD_POST, [], $body);
        $I->seeResponseIsValid($I->getSpecPath(self::ENDPOINT_URL), Request::METHOD_POST, $I->grabResponse(), Response::HTTP_CREATED);
        $I->seeHttpHeader('Location');
    }
}
