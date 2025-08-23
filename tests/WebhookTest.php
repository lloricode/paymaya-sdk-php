<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\RegisterWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\RetrieveWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    fakeCredentials();
});
function sampleData(array $override = []): array
{
    return $override + [
        'name' => \Lloricode\Paymaya\Enums\Webhook::CHECKOUT_SUCCESS,
        'id' => 'test-generated-id',
        'callbackUrl' => 'https://web.test/test/success',
        'createdAt' => '2020-01-05T02:30:57.000Z',
        'updatedAt' => '2021-02-05T02:30:57.000Z',
    ];
}

test('retrieve', function () {
    $sampleData = sampleData();

    $mockClient = MockClient::global([
        RetrieveWebhookRequest::class => MockResponse::make(
            body: [$sampleData],
        ),
    ]);

    $response = (new RetrieveWebhookRequest)
        ->send();

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

it('register', function () {
    $data = sampleData();

    MockClient::global([
        RegisterWebhookRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    /** @var WebhookDto $webhookResponse */
    $webhookResponse = (new RegisterWebhookRequest(
        (new WebhookDto)
            ->setName($data['name'])
            ->setCallbackUrl($data['callbackUrl'])
    ))
        ->send()
        ->dto();

    assertEquals($data['id'], $webhookResponse->id);
    assertEquals($data['name'], $webhookResponse->name);
    assertEquals($data['callbackUrl'], $webhookResponse->callbackUrl);

    assertEquals($data['createdAt'], $webhookResponse->createdAt);
    assertEquals($data['updatedAt'], $webhookResponse->updatedAt);
});

it('update', function () {
    $newUrl = 'https://web.test/test/success-test-new-update';
    $data = sampleData(['callbackUrl' => $newUrl]);

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

it('delete', function () {
    $data = sampleData();

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
