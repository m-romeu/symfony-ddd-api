<?php

declare(strict_types=1);

namespace App\Tests\Support\Helper;

use Codeception\Module;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use cebe\openapi\Reader;
use InvalidArgumentException;

final class AcceptanceHelper extends Module
{
    private const SPEC_FILE = __DIR__ . '/../../../spec/openapi.yaml';
    private const SPEC_PATH_PREFIX = '/api';

    public function getSpecPath(string $url): string
    {
        return self::SPEC_PATH_PREFIX . $url;
    }

    public function seeRequestIsValid(
        string $path,
        string $method,
        array $params = [],
        ?string $content = null,
        array $server = ['CONTENT_TYPE' => 'application/json']
    ): void {
        $this->validateSpecFile(self::SPEC_FILE);

        $validator = (new ValidatorBuilder())
            ->fromYamlFile(self::SPEC_FILE)
            ->getServerRequestValidator();

        $validator->validate($this->buildPsr7Request($path, strtolower($method), $params, $content, $server));
    }

    public function seeResponseIsValid(
        string $path,
        string $method,
        string $content = '',
        int $status = Response::HTTP_OK,
        array $headers = ['Content-Type' => 'application/json']
    ): void {
        $this->validateSpecFile(self::SPEC_FILE);

        $validator = (new ValidatorBuilder())
            ->fromYamlFile(self::SPEC_FILE)
            ->getResponseValidator();

        $operation = new OperationAddress($path, strtolower($method));
        $validator->validate($operation, $this->buildPsr7Response($content, $status, $headers));
    }

    private function buildPsr7Request(
        string $path,
        string $method,
        array $params,
        ?string $content,
        array $server
    ): ServerRequestInterface {
        $psrHttpFactory = new PsrHttpFactory(
            Psr17FactoryDiscovery::findServerRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
            Psr17FactoryDiscovery::findUploadedFileFactory(),
            Psr17FactoryDiscovery::findResponseFactory()
        );

        return $psrHttpFactory->createRequest(
            Request::create($path, $method, $params, [], [], $server, $content)
        );
    }

    private function buildPsr7Response(
        string $content,
        int $status,
        array $headers
    ): ResponseInterface {
        $psrHttpFactory = new PsrHttpFactory(
            Psr17FactoryDiscovery::findServerRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
            Psr17FactoryDiscovery::findUploadedFileFactory(),
            Psr17FactoryDiscovery::findResponseFactory()
        );
        return $psrHttpFactory->createResponse(
            new Response($content, $status, $headers)
        );
    }

    private function validateSpecFile(string $specFile): void
    {
        $openApi = Reader::readFromYamlFile($specFile);

        if ($openApi->validate() === false) {
            $e = $openApi->getErrors();
            $errorMessage = 'Invalid OpenApi Spec File: "' . $specFile . '":';
            $errors = $openApi->getErrors();
            foreach ($errors as $error) {
                $errorMessage .= ' ' . $error . '.';
            }
            throw new InvalidArgumentException($errorMessage);
        }
    }
}
