<?php

use Carbon\Carbon;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Lloricode\Paymaya\Client\WebhookClient;
use Lloricode\Paymaya\Request\Webhook\Webhook;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;

function sampleData(array $override = []): array
{
    return $override + [
            'name' => Webhook::CHECKOUT_SUCCESS,
            'id' => 'test-generated-id',
            'callbackUrl' => 'https://web.test/test/success',
            'createdAt' => '2020-01-05T02:30:57.000Z',
            'updatedAt' => '2021-02-05T02:30:57.000Z',
        ];
}

it('retrieve', function () {
    $sampleData = sampleData();

    $history = [];

    $webhookResponses = (new WebhookClient(
        mockApiClient(
            [
                $sampleData,
            ],
            200,
            $history
        )
    ))
        ->retrieve();


    assertCount(1, $webhookResponses);
    assertCount(1, $history);

    $webhookResponses = array_values($webhookResponses);
    assertEquals($sampleData['id'], $webhookResponses[0]->id);
    assertEquals($sampleData['name'], $webhookResponses[0]->name);
    assertEquals($sampleData['callbackUrl'], $webhookResponses[0]->callbackUrl);
    assertEquals(Carbon::parse($sampleData['createdAt']), $webhookResponses[0]->createdAt);
    assertEquals(Carbon::parse($sampleData['updatedAt']), $webhookResponses[0]->updatedAt);


    /** @var \GuzzleHttp\Psr7\Response $response */
    $response = $history[0]['response'];

    assertEquals(200, $response->getStatusCode());
});

it('register', function () {
    $data = sampleData();

    $webhookResponse = (new WebhookClient(mockApiClient($data)))
        ->register(
            (new Webhook())
                ->setName($data['name'])
                ->setCallbackUrl($data['callbackUrl'])
        );

    assertEquals($data['id'], $webhookResponse->id);
    assertEquals($data['name'], $webhookResponse->name);
    assertEquals($data['callbackUrl'], $webhookResponse->callbackUrl);

    assertEquals(Carbon::parse($data['createdAt']), $webhookResponse->createdAt);
    assertEquals(Carbon::parse($data['updatedAt']), $webhookResponse->updatedAt);
});

it('update', function () {
    $newUrl = 'https://web.test/test/success-test-new-update';
    $data = sampleData(['callbackUrl' => $newUrl]);

    $webhookResponse = (new Webhook());
    $webhookResponse->setId($data['id']);
    $webhookResponse->setName($data['name']);
    $webhookResponse->setCallbackUrl('https://old-url');

    $history = [];

    /** @var Webhook $webhookResponse */
    $webhookResponse = (new WebhookClient(mockApiClient($data, 200, $history)))
        ->update(
            $webhookResponse
                ->setCallbackUrl($newUrl)
        );

    assertCount(1, $history);

    /** @var \GuzzleHttp\Psr7\Response $response */
    $response = $history[0]['response'];

    assertEquals(200, $response->getStatusCode());

    $contentBody = $response->getBody()->getContents();
    assertNotEquals(json_encode($data), $contentBody);

    assertEquals($newUrl, $webhookResponse->callbackUrl);
});

it('delete', function () {
    $data = sampleData();

    $webhookResponse = (new Webhook());
    $webhookResponse->setId($data['id']);
    $webhookResponse->setName($data['name']);
    $webhookResponse->setCallbackUrl($data['callbackUrl']);

    $history = [];

    (new WebhookClient(mockApiClient($data, 200, $history)))
        ->delete(
            $webhookResponse
        );

    assertCount(1, $history);

    /** @var \GuzzleHttp\Psr7\Response $response */
    $response = $history[0]['response'];

    assertEquals(200, $response->getStatusCode());
    assertEquals(json_encode($data), $response->getBody()->getContents());
});


it('delete all', function () {
    $data = [sampleData()];

    $history = [];
    $mock = generatePaymayaClient(
        new MockHandler(
            [
                new Response( // retrieve only
                    200,
                    [],
                    json_encode(
                        $data
                    ),
                ),
                new Response( // delete
                    204, // not actual, just a test since uses DELETE
                    [],
                    '',
                ),
            ]
        ),
        $history
    );

    (new WebhookClient($mock))
        ->deleteAll();

    assertCount(2, $history);

    /** @var \GuzzleHttp\Psr7\Response $response */
    $response0 = $history[0]['response'];

    assertEquals(200, $response0->getStatusCode());
//        assertEquals(json_encode($data), $response0->getBody()->getContents());

    /** @var \GuzzleHttp\Psr7\Response $response */
    $response1 = $history[1]['response'];

    assertEquals(204, $response1->getStatusCode());
//        assertEquals('', $response1->getBody()->getContents());
})->depends('retrieve');
