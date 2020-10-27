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
    public function check_via_sandbox()
    {
        $checkoutResponse = null;

        try {
            $checkoutResponse = CheckoutClient::new(self::generatePaymayaClient())->execute(self::buildCheckout());
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
