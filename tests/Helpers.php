<?php

declare(strict_types=1);

use Lloricode\Paymaya\Constant;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Enums\Webhook;
use Saloon\Http\Faking\MockClient;

function fakeCredentials(): void
{
    Constant::$environment = Environment::testing;
    Constant::$secretKey = 'fake-secretKey';
    Constant::$publicKey = 'fake-publicKey';

    MockClient::destroyGlobal();
}

function sampleWebhookData(array $override = []): array
{
    return $override + [
        'name' => Webhook::CHECKOUT_SUCCESS,
        'id' => 'test-generated-id',
        'callbackUrl' => 'https://web.test/test/success',
        'createdAt' => '2020-01-05T02:30:57.000Z',
        'updatedAt' => '2021-02-05T02:30:57.000Z',
    ];
}
