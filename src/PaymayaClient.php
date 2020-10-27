<?php

namespace Lloricode\Paymaya;

use ErrorException;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

final class PaymayaClient
{
    public const BASE_URL_PRODUCTION = 'https://pg.paymaya.com';
    public const BASE_URL_SANDBOX = 'https://pg-sandbox.paymaya.com';

    public const ENVIRONMENT_SANDBOX = 'sandbox';
    public const ENVIRONMENT_PRODUCTION = 'production';

    private string $public_key;
    private string $secret_key;

    private string $environment;
    private string $base_url;

    /**
     * Client constructor.
     *
     * @param  string  $secretKey
     * @param  string  $publicKey
     * @param  string  $environment
     *
     * @throws \ErrorException
     */
    public function __construct(string $secretKey, string $publicKey, string $environment = self::ENVIRONMENT_SANDBOX)
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
     * @param  string  $uri
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function postClient(string $uri, array $options = []): ResponseInterface
    {
        $client = new GuzzleClient(
            [
                'base_uri' => $this->base_url,
                'headers' => [
                    'Authorization' => trim('Basic '.base64_encode($this->public_key)),
                ],
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
                'headers' => [
                    'Authorization' => trim('Basic '.base64_encode($this->secret_key)),
                ],
            ]
        );

        return $client->get($uri, $options);
    }
}
