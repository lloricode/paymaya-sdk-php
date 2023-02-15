<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;

class CheckoutClient extends BaseClient
{
    public static function uri(int $uriVersion = 1): string
    {
        return "checkout/v$uriVersion/checkouts";
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties */
    public function execute(Checkout $checkoutRequest): CheckoutResponse
    {
        $response = $this->publicPost(['json' => $checkoutRequest]);

        $body = json_decode((string) $response->getBody(), true);

        return new CheckoutResponse($body);
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties */
    public function retrieve(string $id): Checkout
    {
        $response = $this->secretGet($id);

        $body = json_decode($response->getBody()->getContents(), true);

        return new Checkout($body);
    }
}
