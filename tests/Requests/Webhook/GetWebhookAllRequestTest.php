<?php

declare(strict_types=1);

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\GetWebhookAllRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

test('retrieve', function () {
    $sampleData = sampleWebhookData();

    $mockClient = MockClient::global([
        GetWebhookAllRequest::class => MockResponse::make(
            body: [$sampleData],
        ),
    ]);

    $response = paymayaConnectorSend(new GetWebhookAllRequest);

    /** @var list<WebhookDto> $webhookResponses */
    $webhookResponses = $response->dto();

    assertCount(1, $webhookResponses);
    $mockClient->assertSentCount(1);

    $webhookResponses = array_values($webhookResponses);
    assertEquals($sampleData['id'], $webhookResponses[0]->id);
    assertEquals($sampleData['name'], $webhookResponses[0]->name);
    assertEquals($sampleData['callbackUrl'], $webhookResponses[0]->callbackUrl);
    assertEquals($sampleData['createdAt'], $webhookResponses[0]->createdAt);
    assertEquals($sampleData['updatedAt'], $webhookResponses[0]->updatedAt);

    assertEquals(200, $response->status());
});

test('webhook zero data retrieved', function () {

    MockClient::global([
        GetWebhookAllRequest::class => MockResponse::make(
            status: 404,
        ),
    ]);

    $response = paymayaConnectorSend(new GetWebhookAllRequest);

    assertCount(0, $response->dto());

    assertEquals(404, $response->status());
})->todo('handle 404');

it('throw exception', function () {
    $this->expectException(GuzzleException::class);

    MockClient::global([
        GetWebhookAllRequest::class => MockResponse::make(
            status: 400,
        ),
    ]);

    paymayaConnectorSend(new GetWebhookAllRequest);
})->todo('handle exception');
