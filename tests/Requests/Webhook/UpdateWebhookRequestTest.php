<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    fakeCredentials();
});

it('update', function () {
    $newUrl = 'https://web.test/test/success-test-new-update';
    $data = sampleWebhookData(['callbackUrl' => $newUrl]);

    $webhookResponse = (new WebhookDto);
    $webhookResponse->setId($data['id']);
    $webhookResponse->setName($data['name']);
    $webhookResponse->setCallbackUrl('https://old-url');

    $mockClient = MockClient::global([
        UpdateWebhookRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    $response = (new UpdateWebhookRequest(
        $webhookResponse
            ->setCallbackUrl($newUrl)
    ))
        ->send();

    /** @var WebhookDto $webhookResponse */
    $webhookResponse = $response->dto();

    $mockClient->assertSentCount(1);

    assertEquals(200, $response->status());

    assertEquals($newUrl, $webhookResponse->callbackUrl);
});
