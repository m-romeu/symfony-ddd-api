<?php

declare(strict_types = 1);

namespace App\Infrastructure\Controller;

use App\Application\Query\GetBikesQueryHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetBikesController extends BaseController
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, GetBikesQueryHandler $getBikesQueryHandler): Response
    {
        return $this->sendOK($getBikesQueryHandler->__invoke());
    }

}