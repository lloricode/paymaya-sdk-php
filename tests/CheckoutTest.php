<?php

namespace Lloricode\Paymaya\Tests;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Lloricode\Paymaya\Client\Checkout\CheckoutClient;
use Lloricode\Paymaya\Request\Checkout\Checkout;

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
        $id = 'test-generated-id';
        $url = 'http://test';

        $mock = new MockHandler(
            [
                new Response(
                    200,
                    [],
                    json_encode(
                        [
                            'checkoutId' => $id,
                            'redirectUrl' => $url,
                        ]
                    ),
                ),
            ]
        );

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

        $this->assertEquals($id, $checkoutResponse->getCheckoutId());
        $this->assertEquals($url, $checkoutResponse->getRedirectUrl());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @test
     */
    public function show_with_id_success()
    {
//        $this->markTestSkipped();

        $mock = new MockHandler(
            [
                new Response(
                    200,
                    [],
                    '{
    "id": "0762bc86-c2f0-4269-ad18-d6c38871a40c",
    "items": [
        {
            "name": "Canvas Slip Ons",
            "quantity": "1",
            "code": "CVG-096732",
            "description": "Shoes",
            "amount": {
                "value": 100,
                "details": {
                    "discount": "0",
                    "serviceCharge": "0",
                    "shippingFee": "0",
                    "tax": "0",
                    "subtotal": "100"
                }
            },
            "totalAmount": {
                "value": 100,
                "details": {
                    "discount": "0",
                    "serviceCharge": "0",
                    "shippingFee": "0",
                    "tax": "0",
                    "subtotal": "100"
                }
            }
        }
    ],
    "metadata": {
        "smi": "smi",
        "smn": "smn",
        "mci": "mci",
        "mpc": "mpc",
        "mco": "mco",
        "mst": "mst"
    },
    "requestReferenceNumber": "1551191039",
    "receiptNumber": null,
    "createdAt": "2021-02-08T06:44:12.000Z",
    "updatedAt": "2021-02-08T06:44:12.000Z",
    "paymentScheme": null,
    "expressCheckout": true,
    "refundedAmount": "0",
    "canPayPal": false,
    "expiredAt": "2021-02-08T07:44:12.000Z",
    "status": "CREATED",
    "paymentStatus": "PENDING_TOKEN",
    "paymentDetails": {},
    "buyer": {
        "contact": {
            "phone": "+639181008888",
            "email": "merchant@merchantsite.com"
        },
        "firstName": "John",
        "lastName": "Doe",
        "middleName": "Paul",
        "billingAddress": {
            "line1": "6F Launchpad",
            "line2": "Reliance Street",
            "city": "Mandaluyong City",
            "state": "Metro Manila",
            "zipCode": "1552",
            "countryCode": "PH"
        },
        "shippingAddress": {
            "line1": "6F Launchpad",
            "line2": "Reliance Street",
            "city": "Mandaluyong City",
            "state": "Metro Manila",
            "zipCode": "1552",
            "countryCode": "PH"
        }
    },
    "merchant": {
        "currency": "PHP",
        "email": "paymentgatewayteam@paymaya.com",
        "locale": "en",
        "homepageUrl": "http://www.paymaya.com",
        "isEmailToMerchantEnabled": false,
        "isEmailToBuyerEnabled": true,
        "isPaymentFacilitator": false,
        "isPageCustomized": true,
        "supportedSchemes": [
            "Mastercard",
            "Visa",
            "JCB"
        ],
        "canPayPal": false,
        "payPalEmail": null,
        "payPalWebExperienceId": null,
        "expressCheckout": true,
        "name": "PayMaya Developers Portal"
    },
    "totalAmount": {
        "amount": "100",
        "currency": "PHP",
        "details": {
            "discount": "0",
            "serviceCharge": "0",
            "shippingFee": "0",
            "tax": "0",
            "subtotal": "100"
        }
    },
    "redirectUrl": {
        "success": "https://www.merchantsite.com/success",
        "failure": "https://www.merchantsite.com/failure",
        "cancel": "https://www.merchantsite.com/cancel"
    },
    "transactionReferenceNumber": null
}',
                ),
            ]
        );

        $checkoutResponse = (new CheckoutClient(self::generatePaymayaClient($mock)))
            ->retrieve('');

        $this->assertInstanceOf(Checkout::class, $checkoutResponse);
    }
}
