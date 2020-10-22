<?php

namespace Lloricode\Paymaya\Client;

use ErrorException;
use Lloricode\Paymaya\PaymayaClient;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    public int $uri_version = 1;
    protected PaymayaClient $client;

    private function __construct(PaymayaClient $client)
    {
        $this->client = $client;
    }

    public static function new(PaymayaClient $client)
    {
        return new static($client);
    }

    /**
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function postClient(array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->client->postClient($this->uri($uriVersion), $options);
    }

    /**
     * @return \Lloricode\Paymaya\Client\UriVersion[]
     */
    abstract protected function uris(): array;

    /**
     * @param  int|null  $uriVersion
     *
     * @return string
     * @throws \ErrorException
     */
    private function uri(int $uriVersion = null): string
    {
        if (is_null($uriVersion)) {
            $uriVersion = $this->uri_version;
        }

        foreach ($this->uris() as $uri) {
            if ($uri->version == $uriVersion) {
                return $uri->uri;
            }
        }

        throw new ErrorException();
    }
}
