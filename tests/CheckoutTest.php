<?php

namespace Lloricode\Paymaya\Tests;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Lloricode\Paymaya\Client\Checkout\CheckoutClient;

class CheckoutTest extends TestCase
{
    /** @test */
    public function json_check_exact_from_docs()
    {
        $this->assertSame(
            json_encode(json_decode(self::jsonCheckoutDataFromDocs(), true), JSON_PRETTY_PRINT),
            json_encode(self::buildCheckout(), JSON_PRETTY_PRINT)
        );
    }

    /**
     * @test
     */
    public function check_via_sandbox()
    {
        $mock = new MockHandler(
            [
                new Response(
                    200,
                    [],
                    json_encode(
                        [
                            'checkoutId' => '2d8416df-db69-4cbc-a694-2f51d81b85c0',
                            'redirectUrl' => 'http://test',
                        ]
                    ),
                ),
            ]
        );


        $checkoutResponse = null;

        try {
            $checkoutResponse = (new CheckoutClient(self::generatePaymayaClient($mock)))
                ->execute(self::buildCheckout());
        } catch (ErrorException $e) {
            $this->fail('ErrorException');
        } catch (ClientException $e) {
            $this->fail('ClientException: '.$e->getMessage().$e->getResponse()->getBody());
        } catch (GuzzleException $e) {
            $this->fail('GuzzleException');
        }

        $this->assertUUID($checkoutResponse->getId());
        $this->assertTrue(filter_var($checkoutResponse->getUrl(), FILTER_VALIDATE_URL) !== false);
    }
}
