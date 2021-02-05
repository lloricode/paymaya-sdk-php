<?php

namespace Lloricode\Paymaya\Tests;

use ErrorException;
use Lloricode\Paymaya\Client\Checkout\WebhookClient;
use Lloricode\Paymaya\PaymayaClient;

class ExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function invalid_env()
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('Invalid environment `invalid`.');
        $test = new PaymayaClient('', '', 'invalid');
    }

    /**
     * @test
     */
    public function webhook_zero_data_retrieved()
    {
        $history = [];
        $data = WebhookClient::new(
            self::mockApiClient(
                [
                ],
                404,
                $history
            )
        )
            ->retrieve();

        $this->assertCount(0, $data);


        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(404, $response->getStatusCode());
    }
}
