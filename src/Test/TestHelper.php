<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Test;

use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDetailDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\BillingAddressDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\BuyerDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\ContactDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\ShippingAddressDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\ItemDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\MetaDataDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\RedirectUrlDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\TotalAmountDto;
use Lloricode\Paymaya\Request\Checkout\Checkout;

class TestHelper
{
    /** https://hackmd.io/@paymaya-pg/Checkout */
    public static function jsonCheckoutDataFromDocs(): string
    {
        return '{
    "buyer": {
        "billingAddress": {
            "city": "Mandaluyong City",
            "countryCode": "PH",
            "line1": "6F Launchpad",
            "line2": "Reliance Street",
            "state": "Metro Manila",
            "zipCode": "1552"
        },
        "birthday": "1995-10-24",
        "contact": {
            "email": "merchant@merchantsite.com",
            "phone": "+639181008888"
        },
        "customerSince": "1995-10-24",
        "firstName": "John",
        "gender": "M",
        "ipAddress": null,
        "lastName": "Doe",
        "middleName": "Paul",
        "shippingAddress": {
            "city": "Mandaluyong City",
            "countryCode": "PH",
            "email": "merchant@merchantsite.com",
            "firstName": "John",
            "lastName": "Doe",
            "line1": "6F Launchpad",
            "line2": "Reliance Street",
            "middleName": "Paul",
            "phone": "+639181008888",
            "shippingType": "ST",
            "state": "Metro Manila",
            "zipCode": "1552"
        }
    },
    "canPayPal": null,
    "createdAt": null,
    "expiredAt": null,
    "expressCheckout": null,
    "id": null,
    "items": [
        {
            "amount": {
                "details": {
                    "discount": 0,
                    "serviceCharge": 0,
                    "shippingFee": 0,
                    "subtotal": 100,
                    "tax": 0
                },
                "value": 100
            },
            "code": "CVG-096732",
            "description": "Shoes",
            "name": "Canvas Slip Ons",
            "quantity": 1,
            "totalAmount": {
                "details": {
                    "discount": 0,
                    "serviceCharge": 0,
                    "shippingFee": 0,
                    "subtotal": 100,
                    "tax": 0
                },
                "value": 100
            }
        }
    ],
    "merchant": null,
    "metadata": {
        "mci": "mci",
        "mco": "mco",
        "mpc": "mpc",
        "mst": "mst",
        "smi": "smi",
        "smn": "smn"
    },
    "paymentDetails": null,
    "paymentScheme": null,
    "paymentStatus": null,
    "receiptNumber": null,
    "redirectUrl": {
        "cancel": "https://www.merchantsite.com/cancel",
        "failure": "https://www.merchantsite.com/failure",
        "success": "https://www.merchantsite.com/success"
    },
    "refundedAmount": 0,
    "requestReferenceNumber": "1551191039",
    "status": null,
    "totalAmount": {
        "amount": 0,
        "currency": "PHP",
        "details": {
            "discount": 0,
            "serviceCharge": 0,
            "shippingFee": 0,
            "subtotal": 100,
            "tax": 0
        },
        "value": 100
    },
    "transactionReferenceNumber": null,
    "updatedAt": null
}';
    }

    public static function buildCheckout(): CheckoutDto
    {
        return new CheckoutDto(
            totalAmount: new TotalAmountDto(
                currency: 'PHP',
                value: 100,
                details: new AmountDetailDto(
                    subtotal: 100,
                )
            ),
            buyer: new BuyerDto(
                firstName: 'John',
                middleName: 'Paul',
                lastName: 'Doe',
                birthday: '1995-10-24',
                customerSince: '1995-10-24',
                gender: 'M',
                contact: new ContactDto(
                    phone: '+639181008888',
                    email: 'merchant@merchantsite.com',
                ),
                shippingAddress: new ShippingAddressDto(
                    firstName: 'John',
                    middleName: 'Paul',
                    lastName: 'Doe',
                    phone: '+639181008888',
                    email: 'merchant@merchantsite.com',
                    line1: '6F Launchpad',
                    line2: 'Reliance Street',
                    city: 'Mandaluyong City',
                    state: 'Metro Manila',
                    zipCode: '1552',
                    countryCode: 'PH',
                    shippingType: 'ST',
                ),
                billingAddress: new BillingAddressDto(
                    line1: '6F Launchpad',
                    line2: 'Reliance Street',
                    city: 'Mandaluyong City',
                    state: 'Metro Manila',
                    zipCode: '1552',
                    countryCode: 'PH',
                )
            ),
            items: [
                new ItemDto(
                    name: 'Canvas Slip Ons',
                    quantity: 1,
                    code: 'CVG-096732',
                    description: 'Shoes',
                    amount: new AmountDto(
                        value: 100,
                        details: new AmountDetailDto(
                            discount: 0,
                            serviceCharge: 0,
                            shippingFee: 0,
                            tax: 0,
                            subtotal: 100,
                        )
                    ),
                    totalAmount: new AmountDto(
                        value: 100,
                        details: new AmountDetailDto(
                            discount: 0,
                            serviceCharge: 0,
                            shippingFee: 0,
                            tax: 0,
                            subtotal: 100,
                        )
                    )
                ),
            ],
            redirectUrl: new RedirectUrlDto(
                success: 'https://www.merchantsite.com/success',
                failure: 'https://www.merchantsite.com/failure',
                cancel: 'https://www.merchantsite.com/cancel',
            ),
            requestReferenceNumber: '1551191039',
            metadata: new MetaDataDto(
                smi: 'smi',
                smn: 'smn',
                mci: 'mci',
                mpc: 'mpc',
                mco: 'mco',
                mst: 'mst',
            )
        );
    }
}
