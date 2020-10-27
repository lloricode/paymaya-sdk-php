<?php

namespace Lloricode\Paymaya\Tests;

use Lloricode\Paymaya\Client\Checkout\WebhookClient;
use Lloricode\Paymaya\Request\Checkout\WebhookRequest;

class WebhookTest extends TestCase
{
    /**
     * @test
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch_delete_update()
    {
        WebhookClient::new(self::generatePaymayaClient())
            ->deleteAll();

        $this->assertCount(
            0,
            WebhookClient::new(self::generatePaymayaClient())
                ->retrieve()
        );

        WebhookClient::new(self::generatePaymayaClient())
            ->register(
                WebhookRequest::new()
                    ->setName(WebhookRequest::SUCCESS)
                    ->setCallbackUrl('https://web.test/test/success')
            );
        WebhookClient::new(self::generatePaymayaClient())
            ->register(
                WebhookRequest::new()
                    ->setName(WebhookRequest::FAILURE)
                    ->setCallbackUrl('https://web.test/test/failure')
            );
        WebhookClient::new(self::generatePaymayaClient())
            ->register(
                WebhookRequest::new()
                    ->setName(WebhookRequest::DROPOUT)
                    ->setCallbackUrl('https://web.test/test/drop')
            );

        $webhookResponses = WebhookClient::new(self::generatePaymayaClient())
            ->retrieve();

        $this->assertCount(3, $webhookResponses);

        WebhookClient::new(self::generatePaymayaClient())
            ->update(
                WebhookRequest::new()->setResponse($webhookResponses[WebhookRequest::SUCCESS])
                    ->setCallbackUrl('https://web.test/test/update-success')
            );

        $this->assertEquals(
            'https://web.test/test/update-success',
            WebhookClient::new(self::generatePaymayaClient())
                ->retrieve()[WebhookRequest::SUCCESS]->getCallbackUrl()
        );


        // delete all
        WebhookClient::new(self::generatePaymayaClient())
            ->deleteAll();

        $this->assertCount(
            0,
            WebhookClient::new(self::generatePaymayaClient())
                ->retrieve()
        );
    }
}
