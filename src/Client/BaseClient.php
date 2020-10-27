<?php

namespace Lloricode\Paymaya\Client;

use Lloricode\Paymaya\PaymayaClient;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    private PaymayaClient $paymayaClient;

    abstract protected function uri(int $uriVersion): string;

    private function __construct(PaymayaClient $paymayaClient)
    {
        $this->paymayaClient = $paymayaClient;
    }

    public static function new(PaymayaClient $client): self
    {
        return new static($client);
    }

    /**
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretPost(array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->post($this->uri($uriVersion), $options);
    }

    /**
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function publicPost(array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->publicClient()->post($this->uri($uriVersion), $options);
    }

    /**
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretGet(array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->get($this->uri($uriVersion), $options);
    }

    /**
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function publicGet(array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->publicClient()->get($this->uri($uriVersion), $options);
    }

    /**
     * @param  string  $appendUrl
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretPut(string $appendUrl = '', array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->put($this->uri($uriVersion)."/$appendUrl", $options);
    }

    /**
     * @param  string  $appendUrl
     * @param  array  $options
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretDelete(string $appendUrl = '', array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->delete($this->uri($uriVersion)."/$appendUrl", $options);
    }
}
