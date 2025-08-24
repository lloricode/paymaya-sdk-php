<?php

declare(strict_types=1);

use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

it('delete', function () {
    $data = sampleWebhookData();

    $mockClient = MockClient::global([
        DeleteWebhookRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    $response = paymayaConnectorSend(new DeleteWebhookRequest($data['id']));

    $mockClient->assertSentCount(1);

    assertEquals(200, $response->status());
    assertEquals(json_encode($data), $response->body());
});
