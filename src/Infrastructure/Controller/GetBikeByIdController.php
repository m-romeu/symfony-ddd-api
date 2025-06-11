<?php

declare(strict_types = 1);

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Command\CreateBikeCommand;
use App\Application\Command\CreateBikeCommandHandler;

class GetBikeByIdController extends BaseController
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, CreateBikeCommandHandler $createBikeCommandHandler): Response
    {
        return $this->sendOK([]);
    }

}