<?php

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Client\UriVersion;
use Lloricode\Paymaya\Request\Checkout\CheckoutRequest;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;

class CheckoutClient extends BaseClient
{
    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\CheckoutRequest  $checkoutRequest
     * @param  int  $uriVersion
     *
     * @return \Lloricode\Paymaya\Response\Checkout\CheckoutResponse
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(CheckoutRequest $checkoutRequest, int $uriVersion = 1): CheckoutResponse
    {
        $response = $this->postClient(['json' => $checkoutRequest], $uriVersion);

        $body = json_decode((string)$response->getBody(), true);
        return new CheckoutResponse($body['checkoutId'], $body['redirectUrl']);
    }

    /**
     * @inheritDoc
     */
    protected function uris(): array
    {
        return [
            new UriVersion('checkout/v1/checkouts'),
        ];
    }
}
