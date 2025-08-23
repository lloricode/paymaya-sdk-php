<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;

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
