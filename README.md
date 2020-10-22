# Paymaya SDK for PHP [Working In Progress]

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lloricode/paymaya-sdk-php/run-tests?label=tests)](https://github.com/lloricode/paymaya-sdk-php/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)


Paymaya SDK for PHP >= 7.4

## Installation

You can install the package via composer:

```bash
composer require lloricode/paymaya-sdk-php
```

## Usage

### Checkout
``` php

# import
use Carbon\Carbon;
use Lloricode\Paymaya\Client\Checkout\CheckoutClient;
use Lloricode\Paymaya\PaymayaClient;
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

# sample you can copy then test it
CheckoutRequest::new()
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
    ->setMetaDataRequest(
        MetaDataRequest::new()
            ->setSMI('smi')
            ->setSMN('smn')
            ->setMCI('mci')
            ->setMPC('mpc')
            ->setMCO('mco')
            ->setMST('mst')
    );

$checkoutResponse = CheckoutClient::new(
    new PaymayaClient(
        'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl', // secret
        'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah', // public
        PaymayaClient::ENVIRONMENT_SANDBOX
    )
)->post($checkout);

echo 'id: '.$checkoutResponse->getId();
echo 'url: '.$checkoutResponse->getUrl();
```

## Testing

``` bash
vendor/bin/phpunit
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lloric Mayuga Garcia](https://github.com/lloricode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
