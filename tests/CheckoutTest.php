<?php

namespace Lloricode\Paymaya\Tests;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
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
    public function c()
    {
        try {
            CheckoutClient::new(self::generateClient())->post(self::buildCheckout());
        } catch (ErrorException $e) {
            $this->fail('ErrorException');
        } catch (ClientException $e) {
            $this->fail('ClientException:'.$e->getResponse()->getBody());
        } catch (GuzzleException $e) {
            $this->fail('GuzzleException');
        }
    }
}
