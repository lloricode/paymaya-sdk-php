<?php

declare(strict_types=1);

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\Requests\Webhook\RetrieveWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    fakeCredentials();
});

it('set items invalid', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage('Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto::setItems() not found.');

    (new CheckoutDto)
        ->setItems([]);
});

it('invalid getter', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage('Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto::setBlah() not found.');

    (new CheckoutDto)
        ->setBlah('xxx');
});

it('only 1 parameter', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage(
        'Argument of Lloricode\Paymaya\Request\Checkout\Checkout::setId() is 1 expected.'
    );

    (new CheckoutDto)
        ->setId(1);
})->skip();

test('webhook zero data retrieved', function () {

    MockClient::global([
        RetrieveWebhookRequest::class => MockResponse::make(
            status: 404,
        ),
    ]);

    $response = (new RetrieveWebhookRequest)
        ->send();

    assertCount(0, $response->dto());

    assertEquals(404, $response->status());
})->todo('handle 404');

it('throw exception', function () {
    $this->expectException(GuzzleException::class);

    MockClient::global([
        RetrieveWebhookRequest::class => MockResponse::make(
            status: 400,
        ),
    ]);

    (new RetrieveWebhookRequest)
        ->send();
})->todo('handle exception');
