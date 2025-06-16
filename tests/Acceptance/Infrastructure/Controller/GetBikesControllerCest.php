<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Infrastructure\Controller;

use App\Tests\Support\AcceptanceTester;
use Codeception\Util\HttpCode;

final class GetBikesControllerCest
{
    private const ENDPOINT_URL = '/bikes';

    public function testGetBikeById(AcceptanceTester $I): void
    {
        $feature = 'Given a valid request ' .
            'Then I should receive a successful response with all bikes';
        $I->wantTo($feature);
        
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET(self::ENDPOINT_URL);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
    }
}
