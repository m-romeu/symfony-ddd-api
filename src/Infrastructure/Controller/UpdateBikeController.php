<?php

declare(strict_types = 1);

namespace App\Infrastructure\Controller;

use App\Application\Command\UpdateBikeCommand;
use App\Application\Command\UpdateBikeCommandHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateBikeController extends BaseController
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, UpdateBikeCommandHandler $updateBikeCommandHandler): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $command = new UpdateBikeCommand(
            (int) $request->get('id'),
            $parameters['name'],
            $parameters['trademark'],
            $parameters['model'],
            $parameters['price']
        );

        return $this->sendOK([$updateBikeCommandHandler->__invoke($command)]);
    }

}