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
        
        $command = new CreateBikeCommand(
            $request->get('name'),
            $request->get('trademark'),
            $request->get('model'),
            $request->get('price')
        );

        $lastBikeId = $createBikeCommandHandler->__invoke($command);

        return $this->sendCreated($this->generateUrl('getBikeById',['id' => $lastBikeId]));
    }

}