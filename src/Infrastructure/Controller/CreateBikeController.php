<?php

declare(strict_types = 1);

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\Command\CreateBikeCommand;
use App\Application\Command\CreateBikeCommandHandler;

class CreateBikeController extends BaseController
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, CreateBikeCommandHandler $createBikeCommandHandler): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $command = new CreateBikeCommand(
            $parameters['name'],
            $parameters['trademark'],
            $parameters['model'],
            $parameters['price']
        );

        $lastBikeId = $createBikeCommandHandler->__invoke($command); 

        return $this->sendCreated($this->generateUrl('getBikeById',['id' => $lastBikeId]));
    }

}