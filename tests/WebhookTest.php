<?php

namespace Lloricode\Paymaya\Tests;

use Carbon\Carbon;
use Lloricode\Paymaya\Client\Checkout\WebhookClient;
use Lloricode\Paymaya\Request\Checkout\WebhookRequest;
use Lloricode\Paymaya\Response\Checkout\WebhookResponse;

class WebhookTest extends TestCase
{
    private static function sampleData(array $override = []): array
    {
        return $override + [
                'name' => WebhookRequest::SUCCESS,
                'id' => 'test-generated-id',
                'callbackUrl' => 'https://web.test/test/success',
                'createdAt' => '2020-02-05T02:30:57.000Z',
                'updatedAt' => '2021-02-05T02:30:57.000Z',
            ];
    }

    /**
     * @test
     */
    public function retrieve()
    {
        $data = WebhookClient::new(
            self::mockApiClient(
                [
                    [
                        'name' => '',
                        'id' => '',
                        'callbackUrl' => '',
                        'createdAt' => '',
                        'updatedAt' => '',
                    ],
                ]
            )
        )
            ->retrieve();

        $this->assertCount(1, $data);
    }

    /**
     * @test
     */
    public function register()
    {
        $data = self::sampleData();

        /** @var WebhookResponse $webhookResponse */
        $webhookResponse = WebhookClient::new(self::mockApiClient($data))
            ->register(
                WebhookRequest::new()
                    ->setName($data['name'])
                    ->setCallbackUrl($data['callbackUrl'])
            );

        $this->assertEquals($data['id'], $webhookResponse->getId());
        $this->assertEquals($data['name'], $webhookResponse->getName());
        $this->assertEquals($data['callbackUrl'], $webhookResponse->getCallbackUrl());

        $this->assertEquals(Carbon::parse($data['createdAt']), $webhookResponse->getCreatedAt());
        $this->assertEquals(Carbon::parse($data['updatedAt']), $webhookResponse->getUpdatedAt());
    }

    /**
     * @test
     */
    public function update()
    {
        $newUrl = 'https://web.test/test/success-test-new-update';
        $data = self::sampleData(['callbackUrl' => $newUrl]);

        $webhookResponse = WebhookResponse::new();
        $webhookResponse->setId($data['id']);
        $webhookResponse->setName($data['name']);
        $webhookResponse->setCallbackUrl('https://old-url');

        $history = [];

        /** @var WebhookResponse $webhookResponse */
        $webhookResponse = WebhookClient::new(self::mockApiClient($data, 200, $history))
            ->update(
                WebhookRequest::new()->setResponse($webhookResponse)
                    ->setCallbackUrl($newUrl)
            );

        $this->assertCount(1, $history);

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(200, $response->getStatusCode());

        $contentBody = $response->getBody()->getContents();
        $this->assertNotEquals(json_encode($data), $contentBody);

        $this->assertEquals($newUrl, $webhookResponse->getCallbackUrl());
    }

    /**
     * @test
     */
    public function delete()
    {
        $data = self::sampleData();

        $webhookResponse = WebhookResponse::new();
        $webhookResponse->setId($data['id']);
        $webhookResponse->setName($data['name']);
        $webhookResponse->setCallbackUrl($data['callbackUrl']);

        $history = [];

        WebhookClient::new(self::mockApiClient($data, 200, $history))
            ->delete(
                WebhookRequest::new()->setResponse($webhookResponse)
            );

        $this->assertCount(1, $history);

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode($data), $response->getBody()->getContents());
    }
}
