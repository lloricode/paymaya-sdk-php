<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Lloricode\Paymaya\PaymayaClient;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Test\TestHelper;

use function PHPUnit\Framework\assertEquals;

/**
 * @param  array  $array
 * @param  int  $status
 * @param  array  $historyContainer
 *
 * @return \Lloricode\Paymaya\PaymayaClient
 */
function mockApiClient(
    array $array,
    int $status = 200,
    array &$historyContainer = []
): PaymayaClient {
    return generatePaymayaClient(
        new MockHandler(
            [
                new Response(
                    $status,
                    [],
                    json_encode(
                        $array
                    ),
                ),
            ]
        ),
        $historyContainer
    );
}

/**
 * @param  \GuzzleHttp\Handler\MockHandler  $mockHandler
 * @param  array  $historyContainer
 *
 * @return \Lloricode\Paymaya\PaymayaClient
 */
function generatePaymayaClient(
    MockHandler $mockHandler,
    array &$historyContainer = []
): PaymayaClient {
    return (new PaymayaClient(
        '',
        '',
        PaymayaClient::ENVIRONMENT_TESTING
    ))->setHandlerStack(
        HandlerStack::create($mockHandler),
        $historyContainer
    );
}

function buildCheckout(): Checkout
{
    return TestHelper::buildCheckout();
}

/**
 * https://hackmd.io/@paymaya-pg/Checkout
 * @return string
 */
function jsonCheckoutDataFromDocs(): string
{
    return TestHelper::jsonCheckoutDataFromDocs();
}

/**
 * https://stackoverflow.com/a/19989922
 * @param $value
 */
function assertUUID($value): void
{
    $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
    assertEquals(1, preg_match($UUIDv4, $value), 'Not a valid uuid.');
}