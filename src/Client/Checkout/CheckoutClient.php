<?php

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\CheckoutRequest;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;

class CheckoutClient extends BaseClient
{
    public static function uri(int $uriVersion = 1): string
    {
        return "checkout/v$uriVersion/checkouts";
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\CheckoutRequest  $checkoutRequest
     *
     * @return \Lloricode\Paymaya\Response\Checkout\CheckoutResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(CheckoutRequest $checkoutRequest): CheckoutResponse
    {
        $response = $this->publicPost(['json' => $checkoutRequest]);

        $body = json_decode((string)$response->getBody(), true);

        return (new CheckoutResponse())
            ->setId($body['checkoutId'])
            ->setUrl($body['redirectUrl']);
    }
}
