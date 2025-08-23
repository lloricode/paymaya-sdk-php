<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    fakeCredentials();
});

it('delete', function () {
    $data = sampleWebhookData();

    $webhookResponse = (new WebhookDto);
    $webhookResponse->setId($data['id']);
    $webhookResponse->setName($data['name']);
    $webhookResponse->setCallbackUrl($data['callbackUrl']);

    $mockClient = MockClient::global([
        DeleteWebhookRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    $response = (new DeleteWebhookRequest($data['id']))->send();

    $mockClient->assertSentCount(1);

    assertEquals(200, $response->status());
    assertEquals(json_encode($data), $response->body());
});
