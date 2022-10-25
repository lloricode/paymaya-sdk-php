<?php

declare(strict_types=1);

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Client\WebhookClient;
use Lloricode\Paymaya\PaymayaClient;
use Lloricode\Paymaya\Request\Checkout\Checkout;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

it('set items invalid', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage('Lloricode\Paymaya\Request\Checkout\Checkout::setItems() not found.');

    (new Checkout())
        ->setItems([]);
});

it('invalid getter', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage('Lloricode\Paymaya\Request\Checkout\Checkout::setBlah() not found.');

    (new Checkout())
        ->setBlah('xxx');
});

it('only 1 parameter', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage(
        'Argument of Lloricode\Paymaya\Request\Checkout\Checkout::setId() is 1 expected.'
    );

    (new Checkout())
        ->setId(1, 2);
});

it('invalid env', function () {
    $this->expectException(ErrorException::class);
    $this->expectExceptionMessage('Invalid environment `invalid`.');
    $test = new PaymayaClient('', '', 'invalid');
});

test('webhook zero data retrieved', function () {
    $history = [];
    $data = (new WebhookClient(
        mockApiClient(
            [
            ],
            404,
            $history
        )
    ))
        ->retrieve();

    assertCount(0, $data);

    /** @var \GuzzleHttp\Psr7\Response $response */
    $response = $history[0]['response'];

    assertEquals(404, $response->getStatusCode());
});

it('throw exception', function () {
    $this->expectException(GuzzleException::class);
    (new WebhookClient(
        mockApiClient(
            [
            ],
            400,
        )
    ))
        ->retrieve();
});
