<?php

declare(strict_types=1);

use Lloricode\Paymaya\Requests\Checkout\CreateCheckoutRequest;
use Lloricode\Paymaya\Test\TestHelper;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

it('check via sandbox', function () {

    $id = 'test-generated-id';
    $url = 'https://test';

    MockClient::global([
        CreateCheckoutRequest::class => MockResponse::make(
            body: [
                'checkoutId' => $id,
                'redirectUrl' => $url,
            ],
        ),
    ]);

    $checkoutResponse = paymaya()->createCheckout(TestHelper::buildCheckout());

    assertEquals($id, $checkoutResponse->checkoutId);
    assertEquals($url, $checkoutResponse->redirectUrl);
});
