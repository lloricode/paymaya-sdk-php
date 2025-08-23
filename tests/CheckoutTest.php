<?php

declare(strict_types=1);

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\BillingAddressDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\ShippingAddressDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\Request\Checkout\RetrieveCheckoutRequest;
use Lloricode\Paymaya\Request\Checkout\SubmitCheckoutRequest;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetail;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertJsonStringEqualsJsonString;

beforeEach(function () {
    fakeCredentials();
});

test('json check exact from docs', function () {
    assertJsonStringEqualsJsonString(
        jsonCheckoutDataFromDocs(),
        json_encode(buildCheckout())
    );
});

it('check via sandbox', function () {

    $id = 'test-generated-id';
    $url = 'https://test';

    MockClient::global([
        SubmitCheckoutRequest::class => MockResponse::make(
            body: [
                'checkoutId' => $id,
                'redirectUrl' => $url,
            ],
        ),
    ]);

    $checkoutResponse = null;

    try {
        /** @var CheckoutResponse $checkoutResponse */
        $checkoutResponse = (new SubmitCheckoutRequest(buildCheckout()))->send()->dto();
    } catch (ErrorException) {
        $this->fail('ErrorException');
    } catch (ClientException $e) {
        $this->fail('ClientException: '.$e->getMessage().$e->getResponse()->getBody());
    } catch (GuzzleException) {
        $this->fail('GuzzleException');
    }

    assertEquals($id, $checkoutResponse->checkoutId);
    assertEquals($url, $checkoutResponse->redirectUrl);
});

it('show with id success', function () {
    $responseData = '{
    "id": "4ef96167-b8f2-4400-912e-5bd2f4289cfb",
    "items": [
        {
            "name": "Wings (8pcs)",
            "quantity": "2",
            "code": "wings-8pcs",
            "description": "no description",
            "amount": {
                "value": 365,
                "details": {
                    "discount": "0",
                    "serviceCharge": "0",
                    "shippingFee": "0",
                    "tax": "0",
                    "subtotal": "730"
                }
            },
            "totalAmount": {
                "value": 730,
                "details": {
                    "discount": "0",
                    "serviceCharge": "0",
                    "shippingFee": "0",
                    "tax": "0",
                    "subtotal": "730"
                }
            }
        },
        {
            "name": "Garlic Gold",
            "quantity": "4",
            "description": "Wings (8pcs) (variants)",
            "amount": {
                "value": 0,
                "details": {
                    "discount": "0",
                    "serviceCharge": "0",
                    "shippingFee": "0",
                    "tax": "0",
                    "subtotal": "0"
                }
            },
            "totalAmount": {
                "value": 0,
                "details": {
                    "discount": "0",
                    "serviceCharge": "0",
                    "shippingFee": "0",
                    "tax": "0",
                    "subtotal": "0"
                }
            }
        }
    ],
    "metadata": null,
    "requestReferenceNumber": "TEST4BRANC_W2102220001",
    "receiptNumber": "3b2b7ec1a3c0",
    "createdAt": "2021-02-22T02:28:13.000Z",
    "updatedAt": "2021-02-22T02:28:54.000Z",
    "paymentScheme": "visa",
    "expressCheckout": true,
    "refundedAmount": "0",
    "canPayPal": false,
    "expiredAt": "2021-02-22T03:28:13.000Z",
    "status": "COMPLETED",
    "paymentStatus": "PAYMENT_SUCCESS",
    "paymentDetails": {
        "responses": {
            "efs": {
                "paymentTransactionReferenceNo": "854ae496-1725-403b-a2c4-3b2b7ec1a3c0",
                "status": "SUCCESS",
                "receipt": {
                    "transactionId": "c33c40b6-1d69-4d7e-95f9-55b2fcab7b34",
                    "receiptNo": "3b2b7ec1a3c0",
                    "approval_code": "00001234",
                    "approvalCode": "00001234"
                },
                "payer": {
                    "fundingInstrument": {
                        "card": {
                            "cardNumber": "412345******1522",
                            "expiryMonth": "12",
                            "expiryYear": "2025"
                        }
                    }
                },
                "amount": {
                    "total": {
                        "currency": "PHP",
                        "value": 730
                    }
                },
                "created_at": "2021-02-22T02:29:09.361Z"
            }
        },
        "paymentAt": "2021-02-22T02:28:56.000Z",
        "3ds": true
    },
    "buyer": {
        "contact": {
            "phone": "+639123456789",
            "email": "system@wing-zone.com"
        },
        "firstName": "Administrator",
        "lastName": "System",
        "billingAddress": [],
        "shippingAddress": {
            "line1": "1234",
            "countryCode": "PH"
        }
    },
    "merchant": {
        "currency": "PHP",
        "email": "paymentgatewayteam@paymaya.com",
        "locale": "en",
        "homepageUrl": "http:\/\/www.paymaya.com",
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
        "amount": "730",
        "currency": "PHP",
        "details": {
            "discount": "0",
            "serviceCharge": "0",
            "shippingFee": "0",
            "tax": "0",
            "subtotal": "730"
        },
        "value": 0
    },
    "redirectUrl": {
        "success": "https:\/\/staging-api1",
        "failure": "https:\/\/staging-api2",
        "cancel": "https:\/\/staging-api3"
    },
    "transactionReferenceNumber": "xxx"
}';

    MockClient::global([
        RetrieveCheckoutRequest::class => MockResponse::make(
            body: $responseData,
        ),
    ]);

    /** @var CheckoutDto $checkoutResponse */
    $checkoutResponse = (new RetrieveCheckoutRequest('4ef96167-b8f2-4400-912e-5bd2f4289cfb'))->send()->dto();

    assertInstanceOf(CheckoutDto::class, $checkoutResponse);

    assertEquals('4ef96167-b8f2-4400-912e-5bd2f4289cfb', $checkoutResponse->id);
    assertInstanceOf(PaymentDetail::class, $checkoutResponse->paymentDetails);

    // -----

    $expected = json_decode($responseData, true);

    $expected['buyer']['billingAddress'] = new BillingAddressDto;
    $expected['buyer']['shippingAddress'] = new ShippingAddressDto(line1: '1234', countryCode: 'PH');
    $expected['buyer']['birthday'] = null;
    $expected['buyer']['customerSince'] = null;
    $expected['buyer']['gender'] = null;
    $expected['buyer']['ipAddress'] = null;
    $expected['buyer']['middleName'] = null;

    $expected['paymentDetails']['is3ds'] = $expected['paymentDetails']['3ds'];

    unset($expected['paymentDetails']['3ds']);
    assertJsonStringEqualsJsonString(
        json_encode($expected),
        json_encode($checkoutResponse)
    );
});
