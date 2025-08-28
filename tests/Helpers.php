<?php

declare(strict_types=1);

use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Enums\Webhook;
use Lloricode\Paymaya\Paymaya;

function paymaya(): Paymaya
{
    return new Paymaya(
        environment: Environment::Testing,
        secretKey: 'fake-secretKey',
        publicKey: 'fake-publicKey',
    );
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
