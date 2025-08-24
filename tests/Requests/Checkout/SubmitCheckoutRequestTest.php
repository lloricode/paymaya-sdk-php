<?php

declare(strict_types=1);

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Requests\Checkout\SubmitCheckoutRequest;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;
use Lloricode\Paymaya\Test\TestHelper;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

it('check via sandbox', function () {

    $id = 'test-generated-id';
    $url = 'https://test';

    MockClient::global([
        SubmitCheckoutRequest::class => MockResponse::make(
            body: [
                'checkoutId' => $id,
                'redirectUrl' => $url,
            ],
        ),
    ]);

    $checkoutResponse = null;

    try {
        /** @var CheckoutResponse $checkoutResponse */
        $checkoutResponse = paymayaConnectorSend(new SubmitCheckoutRequest(TestHelper::buildCheckout()))->dto();
    } catch (ErrorException) {
        $this->fail('ErrorException');
    } catch (ClientException $e) {
        $this->fail('ClientException: '.$e->getMessage().$e->getResponse()->getBody());
    } catch (GuzzleException) {
        $this->fail('GuzzleException');
    }

    assertEquals($id, $checkoutResponse->checkoutId);
    assertEquals($url, $checkoutResponse->redirectUrl);
});
