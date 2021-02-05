<?php

namespace Lloricode\Paymaya;

use ErrorException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

final class PaymayaClient
{
    public const BASE_URL_PRODUCTION = 'https://pg.paymaya.com';
    public const BASE_URL_SANDBOX = 'https://pg-sandbox.paymaya.com';

    public const ENVIRONMENT_SANDBOX = 'sandbox';
    public const ENVIRONMENT_PRODUCTION = 'production';
    public const ENVIRONMENT_TESTING = 'testing';

    private string $public_key;
    private string $secret_key;

    private string $environment;
    private string $base_url;

    private ?HandlerStack $handler_stack = null;

    /**
     * PaymayaClient constructor.
     *
     * @param  string  $secretKey
     * @param  string  $publicKey
     * @param  string  $environment
     * @param  \GuzzleHttp\HandlerStack|null  $handlerStack
     * @param  array  $historyContainer
     *
     * @throws \ErrorException
     */
    public function __construct(
        string $secretKey,
        string $publicKey,
        string $environment = self::ENVIRONMENT_SANDBOX,
        HandlerStack $handlerStack = null,
        array &$historyContainer = []
    ) {
        switch ($environment) {
            // @codeCoverageIgnoreStart
            case self::ENVIRONMENT_PRODUCTION:
                $this->base_url = self::BASE_URL_PRODUCTION;

                break;
            case self::ENVIRONMENT_SANDBOX:
                $this->base_url = self::BASE_URL_SANDBOX;

                break;
            // @codeCoverageIgnoreEnd
            case self::ENVIRONMENT_TESTING:
                $this->base_url = 'testing';

                $this->handler_stack = $handlerStack;

                if (! is_null($this->handler_stack)) {
                    $this->handler_stack->push(Middleware::history($historyContainer));
                }

                break;
            default:
                throw new ErrorException("Invalid environment `$environment`.");
        }

        $this->environment = $environment;
        $this->secret_key = $secretKey;
        $this->public_key = $publicKey;
    }

    private function client(array $header): GuzzleClient
    {
        return new GuzzleClient(
            [
                'base_uri' => $this->base_url,
                'headers' => $header,
                'handler' => $this->handler_stack,
            ]
        );
    }

    public function publicClient(): GuzzleClient
    {
        return $this->client(
            [
                'Authorization' => trim('Basic '.base64_encode($this->public_key)),
            ]
        );
    }

    public function secretClient(): GuzzleClient
    {
        return $this->client(
            [
                'Authorization' => trim('Basic '.base64_encode($this->secret_key)),
            ]
        );
    }
}
