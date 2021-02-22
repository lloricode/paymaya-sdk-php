<?php

namespace Lloricode\Paymaya\Tests;

use ErrorException;
use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Client\Checkout\WebhookClient;
use Lloricode\Paymaya\PaymayaClient;
use Lloricode\Paymaya\Request\Checkout\Checkout;

class ExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function set_items_invalid()
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('Lloricode\Paymaya\Request\Checkout\Checkout::setItems() not found.');

        (new Checkout())
            ->setItems([]);
    }

    /**
     * @test
     */
    public function invalid_getter()
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('Lloricode\Paymaya\Request\Checkout\Checkout::setBlah() not found.');

        (new Checkout())
            ->setBlah('xxx');
    }

    /**
     * @test
     */
    public function only_1_parameter()
    {
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage(
            'Argument of Lloricode\Paymaya\Request\Checkout\Checkout::setId() is 1 expected.'
        );

        (new Checkout())
            ->setId(1, 2);
    }

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     */
    public function webhook_zero_data_retrieved()
    {
        $history = [];
        $data = (new WebhookClient(
            self::mockApiClient(
                [
                ],
                404,
                $history
            )
        ))
            ->retrieve();

        $this->assertCount(0, $data);


        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function throw_exception()
    {
        $this->expectException(GuzzleException::class);
        (new WebhookClient(
            self::mockApiClient(
                [
                ],
                400,
            )
        ))
            ->retrieve();
    }
}
