<?php

namespace Lloricode\Paymaya\Tests;

use Carbon\Carbon;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Lloricode\Paymaya\Client\Checkout\WebhookClient;
use Lloricode\Paymaya\Request\Checkout\Webhook;

class WebhookTest extends TestCase
{
    private static function sampleData(array $override = []): array
    {
        return $override + [
                'name' => Webhook::SUCCESS,
                'id' => 'test-generated-id',
                'callbackUrl' => 'https://web.test/test/success',
                'createdAt' => '2020-01-05T02:30:57.000Z',
                'updatedAt' => '2021-02-05T02:30:57.000Z',
            ];
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     */
    public function retrieve()
    {
        $sampleData = self::sampleData();

        $history = [];

        $webhookResponses = (new WebhookClient(
            self::mockApiClient(
                [
                    $sampleData,
                ],
                200,
                $history
            )
        ))
            ->retrieve();


        $this->assertCount(1, $webhookResponses);
        $this->assertCount(1, $history);

        $webhookResponses = array_values($webhookResponses);
        $this->assertEquals($sampleData['id'], $webhookResponses[0]->id);
        $this->assertEquals($sampleData['name'], $webhookResponses[0]->name);
        $this->assertEquals($sampleData['callbackUrl'], $webhookResponses[0]->callbackUrl);
        $this->assertEquals(Carbon::parse($sampleData['createdAt']), $webhookResponses[0]->createdAt);
        $this->assertEquals(Carbon::parse($sampleData['updatedAt']), $webhookResponses[0]->updatedAt);


        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     */
    public function register()
    {
        $data = self::sampleData();

        $webhookResponse = (new WebhookClient(self::mockApiClient($data)))
            ->register(
                (new Webhook())
                    ->setName($data['name'])
                    ->setCallbackUrl($data['callbackUrl'])
            );

        $this->assertEquals($data['id'], $webhookResponse->id);
        $this->assertEquals($data['name'], $webhookResponse->name);
        $this->assertEquals($data['callbackUrl'], $webhookResponse->callbackUrl);

        $this->assertEquals(Carbon::parse($data['createdAt']), $webhookResponse->createdAt);
        $this->assertEquals(Carbon::parse($data['updatedAt']), $webhookResponse->updatedAt);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     */
    public function update()
    {
        $newUrl = 'https://web.test/test/success-test-new-update';
        $data = self::sampleData(['callbackUrl' => $newUrl]);

        $webhookResponse = (new Webhook());
        $webhookResponse->setId($data['id']);
        $webhookResponse->setName($data['name']);
        $webhookResponse->setCallbackUrl('https://old-url');

        $history = [];

        /** @var Webhook $webhookResponse */
        $webhookResponse = (new WebhookClient(self::mockApiClient($data, 200, $history)))
            ->update(
                $webhookResponse
                    ->setCallbackUrl($newUrl)
            );

        $this->assertCount(1, $history);

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(200, $response->getStatusCode());

        $contentBody = $response->getBody()->getContents();
        $this->assertNotEquals(json_encode($data), $contentBody);

        $this->assertEquals($newUrl, $webhookResponse->callbackUrl);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     */
    public function delete()
    {
        $data = self::sampleData();

        $webhookResponse = (new Webhook());
        $webhookResponse->setId($data['id']);
        $webhookResponse->setName($data['name']);
        $webhookResponse->setCallbackUrl($data['callbackUrl']);

        $history = [];

        (new WebhookClient(self::mockApiClient($data, 200, $history)))
            ->delete(
                $webhookResponse
            );

        $this->assertCount(1, $history);

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode($data), $response->getBody()->getContents());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     * @depends retrieve
     */
    public function delete_all()
    {
        $data = [self::sampleData()];

        $history = [];
        $mock = self::generatePaymayaClient(
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

        $this->assertCount(2, $history);

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response0 = $history[0]['response'];

        $this->assertEquals(200, $response0->getStatusCode());
//        $this->assertEquals(json_encode($data), $response0->getBody()->getContents());

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response1 = $history[1]['response'];

        $this->assertEquals(204, $response1->getStatusCode());
//        $this->assertEquals('', $response1->getBody()->getContents());
    }
}
