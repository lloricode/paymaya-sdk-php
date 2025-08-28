<?php

declare(strict_types=1);

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Requests\Webhook\GetAllWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

test('retrieve', function () {
    $sampleData = sampleWebhookData();

    $mockClient = MockClient::global([
        GetAllWebhookRequest::class => MockResponse::make(
            body: [$sampleData],
        ),
    ]);

    $webhookResponses = paymaya()->webhooks();

    assertCount(1, $webhookResponses);
    $mockClient->assertSentCount(1);

    $webhookResponses = array_values($webhookResponses);
    assertEquals($sampleData['id'], $webhookResponses[0]->id);
    assertEquals($sampleData['name'], $webhookResponses[0]->name);
    assertEquals($sampleData['callbackUrl'], $webhookResponses[0]->callbackUrl);
    assertEquals($sampleData['createdAt'], $webhookResponses[0]->createdAt);
    assertEquals($sampleData['updatedAt'], $webhookResponses[0]->updatedAt);

});

test('webhook zero data retrieved', function () {

    $mockClient = MockClient::global([
        GetAllWebhookRequest::class => MockResponse::make(
            status: 404,
        ),
    ]);

    $response = paymayaConnectorSend(new GetAllWebhookRequest);

    assertCount(0, $response->dto());

    assertEquals(404, $response->status());
})->todo('handle 404');

it('throw exception', function () {
    $this->expectException(GuzzleException::class);

    MockClient::global([
        GetAllWebhookRequest::class => MockResponse::make(
            status: 400,
        ),
    ]);

    paymayaConnectorSend(new GetAllWebhookRequest);
})->todo('handle exception');
