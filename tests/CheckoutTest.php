<?php

namespace Lloricode\Paymaya\Tests;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetailRequest;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountRequest;
use Lloricode\Paymaya\Request\Checkout\Buyer\BillingAddressRequest;
use Lloricode\Paymaya\Request\Checkout\Buyer\BuyerRequest;
use Lloricode\Paymaya\Request\Checkout\Buyer\ContactRequest;
use Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddressRequest;
use Lloricode\Paymaya\Request\Checkout\CheckoutRequest;
use Lloricode\Paymaya\Request\Checkout\ItemRequest;
use Lloricode\Paymaya\Request\Checkout\MetaDataRequest;
use Lloricode\Paymaya\Request\Checkout\RedirectUrlRequest;
use Lloricode\Paymaya\Request\Checkout\TotalAmountRequest;

class CheckoutTest extends TestCase
{
    /**
     * https://hackmd.io/@paymaya-pg/Checkout
     * @return string
     */
    private static function jsonData(): string
    {
        return '{
  "totalAmount": {
    "currency": "PHP",
    "value": 100.0,
    "details": {
      "discount": 0.0,
      "serviceCharge": 0.0,
      "shippingFee": 0.0,
      "tax": 0.0,
      "subtotal": 100.0
    }
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
    }
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
  "metadata": {}
}';
    }

    /** @test */
    public function json_check_exact_from_docs()
    {
        $checkout = CheckoutRequest::new()
            ->setTotalAmountRequest(
                TotalAmountRequest::new()
                    ->setValue(100)
                    ->setAmountRequest(
                        AmountDetailRequest::new()
                            ->setSubtotal(100)
                    )
            )
            ->setBuyerRequest(
                BuyerRequest::new()
                    ->setFirstName('John')
                    ->setMiddleName('Paul')
                    ->setLastName('Doe')
                    ->setBirthDate(Carbon::parse('1995-10-24'))
                    ->setCustomerSince(Carbon::parse('1995-10-24'))
                    ->setGender('M')
                    ->setContactRequest(
                        ContactRequest::new()
                            ->setPhone('+639181008888')
                            ->setEmail('merchant@merchantsite.com')
                    )
                    ->setShippingAddressRequest(
                        ShippingAddressRequest::new()
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
                    ->setBillingAddressRequest(
                        BillingAddressRequest::new()
                            ->setLine1('6F Launchpad')
                            ->setLine2('Reliance Street')
                            ->setCity('Mandaluyong City')
                            ->setState('Metro Manila')
                            ->setZipCode('1552')
                            ->setCountryCode('PH')
                    )
            )
            ->addItemRequest(
                ItemRequest::new()
                    ->setName('Canvas Slip Ons')
                    ->setQuantity(1)
                    ->setCode('CVG-096732')
                    ->setDescription('Shoes')
                    ->setAmountRequest(
                        AmountRequest::new()
                            ->setValue(100)
                            ->setAmountRequest(
                                AmountDetailRequest::new()
                                    ->setDiscount(0)
                                    ->setServiceCharge(0)
                                    ->setShippingFee(0)
                                    ->setTax(0)
                                    ->setSubtotal(100)
                            )
                    )
                    ->setTotalAmountRequest(
                        AmountRequest::new()
                            ->setValue(100)
                            ->setAmountRequest(
                                AmountDetailRequest::new()
                                    ->setDiscount(0)
                                    ->setServiceCharge(0)
                                    ->setShippingFee(0)
                                    ->setTax(0)
                                    ->setSubtotal(100)
                            )
                    )
            )
            ->setRedirectUrlRequest(
                RedirectUrlRequest::new()
                    ->setSuccess('https://www.merchantsite.com/success')
                    ->setFailure('https://www.merchantsite.com/failure')
                    ->setCancel('https://www.merchantsite.com/cancel')
            )->setRequestReferenceNumber('1551191039')
            ->setMetaDataRequest(MetaDataRequest::new());


        $this->assertSame(json_decode(self::jsonData(), true), $checkout->jsonSerialize());
    }
}
