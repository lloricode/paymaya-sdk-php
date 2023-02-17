<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use ErrorException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class PaymayaClient
{
    public const BASE_URL_PRODUCTION = 'https://pg.paymaya.com';
    public const BASE_URL_SANDBOX = 'https://pg-sandbox.paymaya.com';

    public const ENVIRONMENT_SANDBOX = 'sandbox';
    public const ENVIRONMENT_PRODUCTION = 'production';
    public const ENVIRONMENT_TESTING = 'testing';

    private string $base_url;

    private ?HandlerStack $handler_stack = null;

    /** @throws ErrorException */
    public function __construct(
        private string $secret_key,
        private string $public_key,
        string $environment = self::ENVIRONMENT_SANDBOX
    ) {
        $this->base_url = match ($environment) {
            self::ENVIRONMENT_PRODUCTION => self::BASE_URL_PRODUCTION,
            self::ENVIRONMENT_SANDBOX => self::BASE_URL_SANDBOX,
            self::ENVIRONMENT_TESTING => 'testing',
            default => throw new ErrorException("Invalid environment `$environment`."),
        };
    }

    private function client(array $header): GuzzleClient
    {
        $parameters = [
            'base_uri' => $this->base_url,
            'headers' => $header + ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
        ];

        if ($this->handler_stack != null) {
            $parameters['handler'] = $this->handler_stack;
        }

        return new GuzzleClient($parameters);
    }

    public function publicClient(array $header = []): GuzzleClient
    {
        return $this->client(
            $header + [
                'Authorization' => trim('Basic '.base64_encode($this->public_key)),
            ]
        );
    }

    public function secretClient(array $header = []): GuzzleClient
    {
        return $this->client(
            $header + [
                'Authorization' => trim('Basic '.base64_encode($this->secret_key)),
            ]
        );
    }

    public function setHandlerStack(HandlerStack $handlerStack, array &$historyContainer = []): self
    {
        $handlerStack->push(Middleware::history($historyContainer));

        $this->handler_stack = $handlerStack;

        return $this;
    }
}
