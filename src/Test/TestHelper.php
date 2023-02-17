<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Test;

use Lloricode\Paymaya\Request\Checkout\Amount\Amount;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;
use Lloricode\Paymaya\Request\Checkout\Buyer\BillingAddress;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Request\Checkout\Buyer\Contact;
use Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Request\Checkout\Item;
use Lloricode\Paymaya\Request\Checkout\MetaData;
use Lloricode\Paymaya\Request\Checkout\RedirectUrl;
use Lloricode\Paymaya\Request\Checkout\TotalAmount;

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

    public static function buildCheckout(): Checkout
    {
        return (new Checkout())
            ->setTotalAmount(
                (new TotalAmount())
                    ->setCurrency('PHP')
                    ->setValue(100)
                    ->setDetails(
                        (new AmountDetail())
                            ->setSubtotal(100)
                    )
            )
            ->setBuyer(
                (new Buyer())
                    ->setFirstName('John')
                    ->setMiddleName('Paul')
                    ->setLastName('Doe')
                    ->setBirthday('1995-10-24')
                    ->setCustomerSince('1995-10-24')
                    ->setGender('M')
                    ->setContact(
                        (new Contact())
                            ->setPhone('+639181008888')
                            ->setEmail('merchant@merchantsite.com')
                    )
                    ->setShippingAddress(
                        (new ShippingAddress())
                            ->setFirstName('John')
                            ->setMiddleName('Paul')
                            ->setLastName('Doe')
                            ->setPhone('+639181008888')
                            ->setEmail('merchant@merchantsite.com')
                            ->setLine1('6F Launchpad')
                            ->setLine2('Reliance Street')
                            ->setCity('Mandaluyong City')
                            ->setState('Metro Manila')
                            ->setZipCode('1552')
                            ->setCountryCode('PH')
                            ->setShippingType('ST')
                    )
                    ->setBillingAddress(
                        (new BillingAddress())
                            ->setLine1('6F Launchpad')
                            ->setLine2('Reliance Street')
                            ->setCity('Mandaluyong City')
                            ->setState('Metro Manila')
                            ->setZipCode('1552')
                            ->setCountryCode('PH')
                    )
            )
            ->addItem(
                (new Item())
                    ->setName('Canvas Slip Ons')
                    ->setQuantity(1)
                    ->setCode('CVG-096732')
                    ->setDescription('Shoes')
                    ->setAmount(
                        (new Amount())
                            ->setValue(100)
                            ->setDetails(
                                (new AmountDetail())
                                    ->setDiscount(0)
                                    ->setServiceCharge(0)
                                    ->setShippingFee(0)
                                    ->setTax(0)
                                    ->setSubtotal(100)
                            )
                    )
                    ->setTotalAmount(
                        (new Amount())
                            ->setValue(100)
                            ->setDetails(
                                (new AmountDetail())
                                    ->setDiscount(0)
                                    ->setServiceCharge(0)
                                    ->setShippingFee(0)
                                    ->setTax(0)
                                    ->setSubtotal(100)
                            )
                    )
            )
            ->setRedirectUrl(
                (new RedirectUrl())
                    ->setSuccess('https://www.merchantsite.com/success')
                    ->setFailure('https://www.merchantsite.com/failure')
                    ->setCancel('https://www.merchantsite.com/cancel')
            )
            ->setRequestReferenceNumber('1551191039')
            ->setMetadata(
                (new MetaData())
                    ->setSMI('smi')
                    ->setSMN('smn')
                    ->setMCI('mci')
                    ->setMPC('mpc')
                    ->setMCO('mco')
                    ->setMST('mst')
            );
    }
}
