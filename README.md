# Paymaya SDK for PHP (working in progress for v0.3.0 with major update)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lloricode/paymaya-sdk-php/Tests?label=tests)](https://github.com/lloricode/paymaya-sdk-php/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate?hosted_button_id=V8PYXUNG6QP44)

Paymaya SDK for PHP 7.4 and 8.0, It uses https://github.com/spatie/data-transfer-object

- [Installation](#installation)
- [Usage](#usage)
    - [Checkout](#checkout)
    - [Webhooks Checkout](#checkout-webhook)

## Installation

You can install the package via composer:

```bash
composer require lloricode/paymaya-sdk-php
```

## Usage

You can copy the sample to test it.

### Checkout
https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview
``` php


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

$checkout = (new CheckoutRequest())
    ->setTotalAmountRequest(
        (new TotalAmountRequest())
            ->setValue(100)
            ->setAmountRequest(
                (new AmountDetailRequest())
                    ->setSubtotal(100)
            )
    )
    ->setBuyerRequest(
        (new BuyerRequest())
            ->setFirstName('John')
            ->setMiddleName('Paul')
            ->setLastName('Doe')
            ->setBirthDate(Carbon::parse('1995-10-24'))
            ->setCustomerSince(Carbon::parse('1995-10-24'))
            ->setGender('M')
            ->setContactRequest(
                (new ContactRequest())
                    ->setPhone('+639181008888')
                    ->setEmail('merchant@merchantsite.com')
            )
            ->setShippingAddressRequest(
                (new ShippingAddressRequest())
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
                (new BillingAddressRequest())
                    ->setLine1('6F Launchpad')
                    ->setLine2('Reliance Street')
                    ->setCity('Mandaluyong City')
                    ->setState('Metro Manila')
                    ->setZipCode('1552')
                    ->setCountryCode('PH')
            )
    )
    ->addItemRequest(
        (new ItemRequest())
            ->setName('Canvas Slip Ons')
            ->setQuantity(1)
            ->setCode('CVG-096732')
            ->setDescription('Shoes')
            ->setAmountRequest(
                (new AmountRequest())
                    ->setValue(100)
                    ->setAmountRequest(
                        (new AmountDetailRequest())
                            ->setDiscount(0)
                            ->setServiceCharge(0)
                            ->setShippingFee(0)
                            ->setTax(0)
                            ->setSubtotal(100)
                    )
            )
            ->setTotalAmountRequest(
                (new AmountRequest())
                    ->setValue(100)
                    ->setAmountRequest(
                        (new AmountDetailRequest())
                            ->setDiscount(0)
                            ->setServiceCharge(0)
                            ->setShippingFee(0)
                            ->setTax(0)
                            ->setSubtotal(100)
                    )
            )
    )
    ->setRedirectUrlRequest(
        (new RedirectUrlRequest())
            ->setSuccess('https://www.merchantsite.com/success')
            ->setFailure('https://www.merchantsite.com/failure')
            ->setCancel('https://www.merchantsite.com/cancel')
    )->setRequestReferenceNumber('1551191039')
    ->setMetaDataRequest(
        (new MetaDataRequest())
            ->setSMI('smi')
            ->setSMN('smn')
            ->setMCI('mci')
            ->setMPC('mpc')
            ->setMCO('mco')
            ->setMST('mst')
    );

$checkoutResponse = (new CheckoutClient(
    new PaymayaClient(
        'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl', // secret
        'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah', // public
        PaymayaClient::ENVIRONMENT_SANDBOX
    )
))->execute($checkout);

echo 'id: '.$checkoutResponse->getId()."\n";
echo 'url: '.$checkoutResponse->getUrl()."\n";

```

### Checkout Webhook

```php
use Lloricode\Paymaya\Client\Checkout\WebhookClient;
use Lloricode\Paymaya\PaymayaClient;
use Lloricode\Paymaya\Request\Checkout\Webhook;

$paymayaClient = new PaymayaClient(
    'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl', // secret
    'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah', // public
    PaymayaClient::ENVIRONMENT_SANDBOX
);

(new WebhookClient($paymayaClient))->deleteAll();

// create
(new WebhookClient($paymayaClient))
    ->register(
        (new Webhook())
            ->setName(Webhook::SUCCESS)
            ->setCallbackUrl('https://web.test/test/success')
    );
(new WebhookClient($paymayaClient))
    ->register(
        (new Webhook())
            ->setName(Webhook::FAILURE)
            ->setCallbackUrl('https://web.test/test/failure')
    );
(new WebhookClient($paymayaClient))
    ->register(
        (new Webhook())
            ->setName(Webhook::DROPOUT)
            ->setCallbackUrl('https://web.test/test/drop')
    );

$webhookResponses = (new WebhookClient($paymayaClient))
    ->retrieve();

// update
(new WebhookClient($paymayaClient))
    ->update(
        (new Webhook())->setResponse($webhookResponses[Webhook::SUCCESS])
            ->setCallbackUrl('https://web.test/test/update-success')
    );

// single delete
(new WebhookClient($paymayaClient))
    ->delete(
        (new Webhook())->setResponse($webhookResponses[Webhook::DROPOUT])
    );

// delete all
(new WebhookClient($paymayaClient))
    ->deleteAll();
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
