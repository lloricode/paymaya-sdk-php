<?php

use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDetailDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\RedirectUrlDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\TotalAmountDto;
use Lloricode\Paymaya\Paymaya;
use Lloricode\Paymaya\Enums\Environment;

$api = new Paymaya(
    environment: Environment::Sandbox,
    secretKey: "sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl",
    publicKey: "pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah"
);

$checkout = new CheckoutDto(
    totalAmount: new TotalAmountDto(
        value: 1_000,
        details: new AmountDetailDto(subtotal: 2)
    ),
    redirectUrl: new RedirectUrlDto(
        success: 'https://www.example.com/success',
        failure:'https://www.example.com/failure',
        cancel: 'https://www.example.com/cancel',
    ),
    requestReferenceNumber: "reference_id"
);
$api->createCheckout($checkout);
