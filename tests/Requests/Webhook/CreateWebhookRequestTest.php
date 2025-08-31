<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\CreateWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

it('register', function () {
    $data = sampleWebhookData();

    MockClient::global([
        CreateWebhookRequest::class => new MockResponse(
            body: $data,
        ),
    ]);

    $webhookResponse = paymaya()->createWebhook(
        new WebhookDto(
            name: $data['name'],
            callbackUrl: $data['callbackUrl'],
        )
    );

    assertEquals($data['id'], $webhookResponse->id);
    assertEquals($data['name'], $webhookResponse->name);
    assertEquals($data['callbackUrl'], $webhookResponse->callbackUrl);

    assertEquals($data['createdAt'], $webhookResponse->createdAt);
    assertEquals($data['updatedAt'], $webhookResponse->updatedAt);
});
