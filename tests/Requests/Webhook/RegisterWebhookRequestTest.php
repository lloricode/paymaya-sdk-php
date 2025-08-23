<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\RegisterWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    fakeCredentials();
});

it('register', function () {
    $data = sampleWebhookData();

    MockClient::global([
        RegisterWebhookRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    /** @var WebhookDto $webhookResponse */
    $webhookResponse = (new RegisterWebhookRequest(
        new WebhookDto(
            name: $data['name'],
            callbackUrl: $data['callbackUrl'],
        )
    ))
        ->send()
        ->dto();

    assertEquals($data['id'], $webhookResponse->id);
    assertEquals($data['name'], $webhookResponse->name);
    assertEquals($data['callbackUrl'], $webhookResponse->callbackUrl);

    assertEquals($data['createdAt'], $webhookResponse->createdAt);
    assertEquals($data['updatedAt'], $webhookResponse->updatedAt);
});
