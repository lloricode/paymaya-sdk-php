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
        return (new CheckoutDto)
            ->setTotalAmount(
                (new TotalAmountDto)
                    ->setCurrency('PHP')
                    ->setValue(100)
                    ->setDetails(
                        (new AmountDetailDto)
                            ->setSubtotal(100)
                    )
            )
            ->setBuyer(
                (new BuyerDto)
                    ->setFirstName('John')
                    ->setMiddleName('Paul')
                    ->setLastName('Doe')
                    ->setBirthday('1995-10-24')
                    ->setCustomerSince('1995-10-24')
                    ->setGender('M')
                    ->setContact(
                        (new ContactDto)
                            ->setPhone('+639181008888')
                            ->setEmail('merchant@merchantsite.com')
                    )
                    ->setShippingAddress(
                        (new ShippingAddressDto)
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
                        (new BillingAddressDto)
                            ->setLine1('6F Launchpad')
                            ->setLine2('Reliance Street')
                            ->setCity('Mandaluyong City')
                            ->setState('Metro Manila')
                            ->setZipCode('1552')
                            ->setCountryCode('PH')
                    )
            )
            ->addItem(
                (new ItemDto)
                    ->setName('Canvas Slip Ons')
                    ->setQuantity(1)
                    ->setCode('CVG-096732')
                    ->setDescription('Shoes')
                    ->setAmount(
                        (new AmountDto)
                            ->setValue(100)
                            ->setDetails(
                                (new AmountDetailDto)
                                    ->setDiscount(0)
                                    ->setServiceCharge(0)
                                    ->setShippingFee(0)
                                    ->setTax(0)
                                    ->setSubtotal(100)
                            )
                    )
                    ->setTotalAmount(
                        (new AmountDto)
                            ->setValue(100)
                            ->setDetails(
                                (new AmountDetailDto)
                                    ->setDiscount(0)
                                    ->setServiceCharge(0)
                                    ->setShippingFee(0)
                                    ->setTax(0)
                                    ->setSubtotal(100)
                            )
                    )
            )
            ->setRedirectUrl(
                (new RedirectUrlDto)
                    ->setSuccess('https://www.merchantsite.com/success')
                    ->setFailure('https://www.merchantsite.com/failure')
                    ->setCancel('https://www.merchantsite.com/cancel')
            )
            ->setRequestReferenceNumber('1551191039')
            ->setMetadata(
                (new MetaDataDto)
                    ->setSMI('smi')
                    ->setSMN('smn')
                    ->setMCI('mci')
                    ->setMPC('mpc')
                    ->setMCO('mco')
                    ->setMST('mst')
            );
    }
}
