<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

it('update', function () {
    $newUrl = 'https://web.test/test/success-test-new-update';
    $data = sampleWebhookData(['callbackUrl' => $newUrl]);

    $mockClient = MockClient::global([
        UpdateWebhookRequest::class => new MockResponse(
            body: $data,
        ),
    ]);

    $webhookResponse = paymaya()->updateWebhooks(
        new WebhookDto(
            id: $data['id'],
            name: $data['name'],
            callbackUrl: $newUrl,
        )
    );

    $mockClient->assertSentCount(1);

    assertEquals($newUrl, $webhookResponse->callbackUrl);
});
