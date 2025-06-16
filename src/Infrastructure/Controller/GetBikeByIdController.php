<?php

declare(strict_types = 1);

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Query\GetBikeByIdQuery;
use App\Application\Query\GetBikeByIdQueryHandler;

class GetBikeByIdController extends BaseController
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, GetBikeByIdQueryHandler $getBikeByIdQueryHandler): Response
    {
        $query = new GetBikeByIdQuery((int) $request->get('id'));

        return $this->sendOK($getBikeByIdQueryHandler->__invoke($query));
    }

}