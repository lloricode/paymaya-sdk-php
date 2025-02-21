<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Client;

use Lloricode\Paymaya\PaymayaClient;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    private int $version = 1;

    abstract public static function uri(int $uriVersion = 1): string;

    public function __construct(private readonly PaymayaClient $paymayaClient) {}

    public function version(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    protected function secretPost(array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->post(static::uri($this->version), $options);
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    protected function publicPost(array $options = []): ResponseInterface
    {
        return $this->paymayaClient->publicClient()->post(static::uri($this->version), $options);
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    protected function secretGet(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->get(static::uri($this->version)."/$appendUrl", $options);
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

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    protected function secretPut(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->put(static::uri($this->version)."/$appendUrl", $options);
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    protected function secretDelete(string $appendUrl = '', array $options = []): ResponseInterface
    {
        return $this->paymayaClient->secretClient()->delete(static::uri($this->version)."/$appendUrl", $options);
    }
}
