<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Infrastructure\Controller;

use App\Tests\Support\AcceptanceTester;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Codeception\Util\HttpCode;

final class UpdateBikeControllerCest
{
    private const ENDPOINT_URL = '/bikes/{id}';

    public function testUpdateBike(AcceptanceTester $I): void
    {
        $feature = 'Given a valid request ' .
            'Then I should receive a successful response with the bike updated';
        $I->wantTo($feature);

        $body = json_encode(
            [   
                "name" => "new bike name",
                "trademark" => "trek",
                "model" => "8000 WSD",
                "price" => 1100.00
            ]
        );

        $url = str_replace("{id}", "1", self::ENDPOINT_URL);
        
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->sendPUT($url, $body);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains("new bike name", $response);
        $I->seeRequestIsValid($I->getSpecPath($url), Request::METHOD_PUT, [], $body);
        $I->seeResponseIsValid($I->getSpecPath($url), Request::METHOD_PUT, $I->grabResponse(), Response::HTTP_OK);

    }
}
