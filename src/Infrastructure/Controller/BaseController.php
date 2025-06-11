<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use JsonSerializable;

abstract class BaseController extends AbstractController
{
    protected const API_PREFIX = '/api';

    protected function generateUrl(string $route, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        return self::API_PREFIX . parent::generateUrl($route, $parameters, $referenceType);
    }

    protected function sendOK(JsonSerializable|array $data): JsonResponse
    {
        return new JsonResponse($data, Response::HTTP_OK);
    }

    protected function sendCreated(string $location): Response
    {
        $response = new Response();
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->headers->set('Location', $location);

        return $response;
    }
}
