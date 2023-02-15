<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Test;

use Carbon\Carbon;
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
    "id": null,
  "totalAmount": {
    "value": 100.0,
    "details": {
      "discount": 0.0,
      "serviceCharge": 0.0,
      "shippingFee": 0.0,
      "tax": 0.0,
      "subtotal": 100.0
    },
    "currency": "PHP"
  },
  "buyer": {
    "firstName": "John",
    "middleName": "Paul",
    "lastName": "Doe",
    "birthday": "1995-10-24",
    "customerSince": "1995-10-24",
    "sex": "M",
    "contact": {
      "phone": "+639181008888",
      "email": "merchant@merchantsite.com"
    },
    "shippingAddress": {
      "firstName": "John",
      "middleName": "Paul",
      "lastName": "Doe",
      "phone": "+639181008888",
      "email": "merchant@merchantsite.com",
      "line1": "6F Launchpad",
      "line2": "Reliance Street",
      "city": "Mandaluyong City",
      "state": "Metro Manila",
      "zipCode": "1552",
      "countryCode": "PH",
      "shippingType": "ST"
    },
    "billingAddress": {
      "line1": "6F Launchpad",
      "line2": "Reliance Street",
      "city": "Mandaluyong City",
      "state": "Metro Manila",
      "zipCode": "1552",
      "countryCode": "PH"
    },
    "ipAddress": null
  },
  "items": [
    {
      "name": "Canvas Slip Ons",
      "quantity": 1,
      "code": "CVG-096732",
      "description": "Shoes",
      "amount": {
        "value": 100.0,
        "details": {
          "discount": 0.0,
          "serviceCharge": 0.0,
          "shippingFee": 0.0,
          "tax": 0.0,
          "subtotal": 100.0
        }
      },
      "totalAmount": {
        "value": 100.0,
        "details": {
          "discount": 0.0,
          "serviceCharge": 0.0,
          "shippingFee": 0.0,
          "tax": 0.0,
          "subtotal": 100.0
        }
      }
    }
  ],
  "redirectUrl": {
    "success": "https://www.merchantsite.com/success",
    "failure": "https://www.merchantsite.com/failure",
    "cancel": "https://www.merchantsite.com/cancel"
  },
  "requestReferenceNumber": "1551191039",
  "metadata": {
        "smi": "smi",
        "smn": "smn",
        "mci": "mci",
        "mpc": "mpc",
        "mco": "mco",
        "mst": "mst"
    },
    "status": null,
    "paymentStatus": null
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
                    ->setBirthday(Carbon::parse('1995-10-24'))
                    ->setCustomerSince(Carbon::parse('1995-10-24'))
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
