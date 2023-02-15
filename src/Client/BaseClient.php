<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Client;

use Lloricode\Paymaya\PaymayaClient;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    private PaymayaClient $paymayaClient;
    private int $version = 1;

    abstract public static function uri(int $uriVersion = 1): string;

    public function __construct(PaymayaClient $paymayaClient)
    {
        $this->paymayaClient = $paymayaClient;
    }

    public function version(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretPost(array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->post($this->uri($this->version), $options);
    }

    /**
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function publicPost(array $options = []): ResponseInterface
    {
        return $this->paymayaClient->publicClient()->post($this->uri($this->version), $options);
    }

    /**
     * @param  string  $appendUrl
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretGet(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->get($this->uri($this->version)."/$appendUrl", $options);
    }

    // uncomment when needed
//    /**
//     * @param  array  $options
//     *
//     * @return \Psr\Http\Message\ResponseInterface
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     */
//    protected function publicGet(array $options = []): ResponseInterface
//    {
//        return $this->paymayaClient->publicClient()->get($this->uri($this->version), $options);
//    }

    /**
     * @param  string  $appendUrl
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretPut(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->put($this->uri($this->version)."/$appendUrl", $options);
    }

    /**
     * @param  string  $appendUrl
     * @param  array  $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function secretDelete(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->delete($this->uri($this->version)."/$appendUrl", $options);
    }
}
