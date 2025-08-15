<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use ErrorException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class PaymayaClient
{
    public const string BASE_URL_PRODUCTION = 'https://pg.paymaya.com';

    public const string BASE_URL_SANDBOX = 'https://pg-sandbox.paymaya.com';

    public const string ENVIRONMENT_SANDBOX = 'sandbox';

    public const string ENVIRONMENT_PRODUCTION = 'production';

    public const string ENVIRONMENT_TESTING = 'testing';

    private readonly string $base_url;

    private int $timeout = 3;

    private ?HandlerStack $handler_stack = null;

    /** @throws ErrorException */
    public function __construct(
        private readonly string $secret_key,
        private readonly string $public_key,
        string $environment = self::ENVIRONMENT_SANDBOX
    ) {
        $this->base_url = match ($environment) {
            self::ENVIRONMENT_PRODUCTION => self::BASE_URL_PRODUCTION,
            self::ENVIRONMENT_SANDBOX => self::BASE_URL_SANDBOX,
            self::ENVIRONMENT_TESTING => 'testing',
            default => throw new ErrorException("Invalid environment `$environment`."),
        };
    }

    private function client(array $header): Client
    {
        $config = [
            'base_uri' => $this->base_url,
            'headers' => $header + [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'timeout' => $this->timeout,
        ];

        if ($this->handler_stack !== null) {
            $config['handler'] = $this->handler_stack;
        }

        return new Client($config);
    }

    public function publicClient(array $header = []): Client
    {
        return $this->client(
            $header + [
                'Authorization' => trim('Basic '.base64_encode($this->public_key)),
            ]
        );
    }

    public function secretClient(array $header = []): Client
    {
        return $this->client(
            $header + [
                'Authorization' => trim('Basic '.base64_encode($this->secret_key)),
            ]
        );
    }

    public function setHandlerStack(HandlerStack $handlerStack, array &$historyContainer = []): static
    {
        /** @phpstan-ignore parameterByRef.type */
        $handlerStack->push(Middleware::history($historyContainer));

        $this->handler_stack = $handlerStack;

        return $this;
    }

    public function setTimeout(int $timeout): static
    {
        $this->timeout = $timeout;

        return $this;
    }
}
