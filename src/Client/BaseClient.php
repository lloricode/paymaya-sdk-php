<?php

namespace Lloricode\Paymaya\Client;

use Lloricode\Paymaya\PaymayaClient;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    protected PaymayaClient $paymayaClient;

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
    protected function postClient(array $options = [], int $uriVersion = 1): ResponseInterface
    {
        return $this->paymayaClient->postClient($this->uri($uriVersion), $options);
    }
}
