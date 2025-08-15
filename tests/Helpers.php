<?php

declare(strict_types=1);

use Lloricode\Paymaya\Constant;
use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Test\TestHelper;
use Saloon\Http\Faking\MockClient;

use function PHPUnit\Framework\assertEquals;

function fakeCredencials(): void
{

    Constant::$environment = Environment::testing;
    Constant::$secretKey = 'sk-....';
    Constant::$publicKey = 'pk-.....';

    MockClient::destroyGlobal();
}

function buildCheckout(): CheckoutDto
{
    return TestHelper::buildCheckout();
}

/**
 * https://hackmd.io/@paymaya-pg/Checkout
 */
function jsonCheckoutDataFromDocs(): string
{
    return TestHelper::jsonCheckoutDataFromDocs();
}

/**
 * https://stackoverflow.com/a/19989922
 */
function assertUUID($value): void
{
    $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
    assertEquals(1, preg_match($UUIDv4, (string) $value), 'Not a valid uuid.');
}
