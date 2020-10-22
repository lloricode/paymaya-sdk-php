<?php

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Client\UriVersion;
use Lloricode\Paymaya\Request\Checkout\CheckoutRequest;
use Psr\Http\Message\ResponseInterface;

class CheckoutClient extends BaseClient
{
    /**
     * @inheritDoc
     */
    protected function uris(): array
    {
        return [
            new UriVersion('checkout/v1/checkouts'),
        ];
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\CheckoutRequest  $checkoutRequest
     * @param  int  $uriVersion
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(CheckoutRequest $checkoutRequest, int $uriVersion = 1): ResponseInterface
    {
        return $this->postClient(['json' => $checkoutRequest], $uriVersion);
    }
}
