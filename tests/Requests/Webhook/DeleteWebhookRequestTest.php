<?php

declare(strict_types=1);

use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('delete', function () {
    $data = sampleWebhookData();

    $mockClient = MockClient::global([
        DeleteWebhookRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    paymaya()->deleteWebhook($data['id']);

    $mockClient->assertSentCount(1);

});
