![Paymaya SDK](https://banners.beyondco.de/Paymaya%20SDK%20PHP.png?theme=light&packageManager=composer+require&packageName=lloricode%2Fpaymaya-sdk-php&pattern=architect&style=style_2&description=Paymaya+SDK+for+PHP&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Fwww.php.net%2Fimages%2Flogos%2Fnew-php-logo.svg)

# Paymaya SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/lloricode/paymaya-sdk-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/lloricode/paymaya-sdk-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![codecov](https://codecov.io/gh/lloricode/paymaya-sdk-php/branch/main/graph/badge.svg?token=S1INCAHVSV)](https://app.codecov.io/gh/lloricode/paymaya-sdk-php/tree/main)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate?hosted_button_id=V8PYXUNG6QP44)

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/D1D71HJZD)

Paymaya SDK for PHP.

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

use Lloricode\Paymaya\Constant;
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
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Requests\RetrieveCheckoutRequest;
use Lloricode\Paymaya\Requests\SubmitCheckoutRequest;

Constant::$environment = Environment::sandbox;
Constant::$secretKey = 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl';
Constant::$publicKey = 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah';

$checkout = (new CheckoutDto)
    ->setTotalAmount(
        (new TotalAmountDto)
            ->setValue(100)
            ->setDetails((new AmountDetailDto)->setSubtotal(100))
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
                (new AmountDto)->setValue(100)->setDetails(
                    (new AmountDetailDto)
                        ->setDiscount(0)
                        ->setServiceCharge(0)
                        ->setShippingFee(0)
                        ->setTax(0)
                        ->setSubtotal(100)
                )
            )
            ->setTotalAmount(
                (new AmountDto)->setValue(100)->setDetails(
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

// submit
$checkoutResponse = (new SubmitCheckoutRequest($checkout))->send()->dto();

echo 'id: '.$checkoutResponse->checkoutId."\n";
echo 'url: '.$checkoutResponse->redirectUrl."\n";

// retrieve
(new RetrieveCheckoutRequest($checkoutResponse->checkoutId))->send()->dto();

```

### Customization

```php

use Lloricode\Paymaya\Constant;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Requests\Customization\DeleteCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RegisterCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;

Constant::$environment = Environment::sandbox;
Constant::$secretKey = 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl';
Constant::$publicKey = 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah';

// register
(new RegisterCustomizationRequest(
    (new CustomizationDto)
        ->setLogoUrl('https://image-logo.png')
        ->setIconUrl('https://image-icon.png')
        ->setAppleTouchIconUrl('https://image-apple.png')
        ->setCustomTitle('Test Title Mock')
        ->setColorScheme('#e01c44')
))
    ->send()
    ->dto();

// retrieve
(new RetrieveCustomizationRequest)->send()->dto();

// delete
(new DeleteCustomizationRequest)->send();

```

### Webhook

```php

use Lloricode\Paymaya\Constant;
use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Enums\Webhook;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\RegisterWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\RetrieveWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;

Constant::$environment = Environment::sandbox;
Constant::$secretKey = 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl';
Constant::$publicKey = 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah';

// retrieve
/** @var array<string, WebhookDto> $webhooks */
$webhooks = (new RetrieveWebhookRequest)->send()->dto();

// delete all
foreach ($webhooks as $webhook) {
    (new DeleteWebhookRequest($webhook->id))->send();
}

// register
(new RegisterWebhookRequest(
    (new WebhookDto)
        ->setName(Webhook::CHECKOUT_SUCCESS)
        ->setCallbackUrl('https://web.test/test/success')
))->send();

(new RegisterWebhookRequest(
    (new WebhookDto)
        ->setName(Webhook::CHECKOUT_FAILURE)
        ->setCallbackUrl('https://web.test/test/failure')
))->send();

(new RegisterWebhookRequest(
    (new WebhookDto)
        ->setName(Webhook::CHECKOUT_DROPOUT)
        ->setCallbackUrl('https://web.test/test/drop')
))->send();

// update
$webhooks = (new UpdateWebhookRequest(
    $webhooks[Webhook::CHECKOUT_SUCCESS]->setCallbackUrl(
        'https://web.test/test/update-success'
    )
))
    ->send()
    ->dto();

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
