<?php

namespace Lloricode\Paymaya;

use ErrorException;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

final class Client
{
    public const BASE_URL_PRODUCTION = 'https://pg.paymaya.com';
    public const BASE_URL_SANDBOX = 'https://pg-sandbox.paymaya.com';

    public const ENVIRONMENT_SANDBOX = 'sandbox';
    public const ENVIRONMENT_PRODUCTION = 'production';

    private string $public_key;
    private string $secret_key;

    private string $environment;
    private string $base_url;

    public function __construct($secretKey, $publicKey, $environment = self::BASE_URL_SANDBOX)
    {
        switch ($environment) {
            case self::ENVIRONMENT_PRODUCTION:
                $this->base_url = self::BASE_URL_PRODUCTION;

                break;
            case self::ENVIRONMENT_SANDBOX:
                $this->base_url = self::BASE_URL_SANDBOX;

                break;
            default:
                throw new ErrorException("Invalid environment `$environment`.");
        }

        $this->environment = $environment;
        $this->secret_key = $secretKey;
        $this->public_key = $publicKey;
    }

    /**
     * @param $uri
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function postClient($uri, array $options = []): ResponseInterface
    {
        $client = new GuzzleClient(
            [
                'base_uri' => $this->base_url,
                'auth' => [$this->secret_key, ''],
            ]
        );

        return $client->post($uri, $options);
    }

    /**
     * @param $uri
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getClient($uri, array $options = []): ResponseInterface
    {
        $client = new GuzzleClient(
            [
                'base_uri' => $this->base_url,
                'auth' => [$this->public_key, ''],
            ]
        );

        return $client->get($uri, $options);
    }
}
