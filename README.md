# Paymaya SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/lloricode/paymaya-sdk-php/Tests?label=tests)](https://github.com/lloricode/paymaya-sdk-php/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate?hosted_button_id=V8PYXUNG6QP44)

Paymaya SDK for PHP 7.4 and 8.0, It uses https://github.com/spatie/data-transfer-object

- [Installation](#installation)
- [Usage](#usage)
    - [Checkout](#checkout)
    - [Customization](#customization)
    - [Webhooks](#webhook)
       - [Checkout](#checkout-webhook)

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
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;
use Lloricode\Paymaya\Request\Checkout\Buyer\BillingAddress;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Request\Checkout\Buyer\Contact;
use Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Request\Checkout\Item;
use Lloricode\Paymaya\Request\Checkout\MetaData;
use Lloricode\Paymaya\Request\Checkout\RedirectUrl;
use Lloricode\Paymaya\Request\Checkout\TotalAmount;

$checkout = (new Checkout())
    ->setTotalAmount(
        (new TotalAmount())
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
    )->setRequestReferenceNumber('1551191039')
    ->setMetadata(
        (new MetaData())
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

echo 'id: '.$checkoutResponse->checkoutId."\n";
echo 'url: '.$checkoutResponse->redirectUrl."\n";

```

### Customization

#### register

```php
use Lloricode\Paymaya\Client\Checkout\CustomizationClient;
use Lloricode\Paymaya\Request\Checkout\Customization\Customization;
use Lloricode\Paymaya\PaymayaClient;

$customization = (new CustomizationClient(
        new PaymayaClient(
            'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl', // secret
            'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah', // public
            PaymayaClient::ENVIRONMENT_SANDBOX
        )
    ))
    ->register(
        (new Customization())
            ->setLogoUrl('https://image-logo.png')
            ->setIconUrl('https://image-icon.png')
            ->setAppleTouchIconUrl('https://image-apple.png')
            ->setCustomTitle('Test Title Mock')
            ->setColorScheme('#e01c44')
    );
                
echo $customization->customTitle; //check all properties in class
```
#### retrieve

```php
use Lloricode\Paymaya\Client\Checkout\CustomizationClient;
use Lloricode\Paymaya\Request\Checkout\Customization\Customization;
use Lloricode\Paymaya\PaymayaClient;

$customization = (new CustomizationClient(
         new PaymayaClient(
            'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl', // secret
            'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah', // public
            PaymayaClient::ENVIRONMENT_SANDBOX
        )
    ))
        ->retrieve();
            
echo $customization->customTitle; //check all properties in class
```

### Webhook

#### Checkout Webhook

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
            ->setName(Webhook::CHECKOUT_SUCCESS)
            ->setCallbackUrl('https://web.test/test/success')
    );
(new WebhookClient($paymayaClient))
    ->register(
        (new Webhook())
            ->setName(Webhook::CHECKOUT_FAILURE)
            ->setCallbackUrl('https://web.test/test/failure')
    );
(new WebhookClient($paymayaClient))
    ->register(
        (new Webhook())
            ->setName(Webhook::CHECKOUT_DROPOUT)
            ->setCallbackUrl('https://web.test/test/drop')
    );

$webhookResponses = (new WebhookClient($paymayaClient))
    ->retrieve();

// update
(new WebhookClient($paymayaClient))
    ->update(
        $webhookResponses[Webhook::CHECKOUT_SUCCESS]
            ->setCallbackUrl('https://web.test/test/update-success')
    );

// single delete
(new WebhookClient($paymayaClient))
    ->delete(
        $webhookResponses[Webhook::CHECKOUT_DROPOUT]
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
