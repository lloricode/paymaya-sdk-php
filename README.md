![Paymaya SDK](https://banners.beyondco.de/Paymaya%20SDK%20PHP.png?theme=light&packageManager=composer+require&packageName=lloricode%2Fpaymaya-sdk-php&pattern=architect&style=style_2&description=Paymaya+SDK+for+PHP&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Fwww.php.net%2Fimages%2Flogos%2Fnew-php-logo.svg)

# PayMaya SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/lloricode/paymaya-sdk-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/lloricode/paymaya-sdk-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![codecov](https://codecov.io/gh/lloricode/paymaya-sdk-php/branch/main/graph/badge.svg?token=S1INCAHVSV)](https://app.codecov.io/gh/lloricode/paymaya-sdk-php/tree/main)

---

A modern and type-safe **PayMaya SDK for PHP**, built with [Saloon](https://docs.saloon.dev/) on top of Guzzle.  
Provides an elegant API for working with **Checkout**, **Customizations**, and **Webhooks**.

---

## Support us

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/D1D71HJZD)  
If you find this package helpful, consider supporting its development via Ko-fi or [PayPal](https://www.paypal.com/donate?hosted_button_id=V8PYXUNG6QP44).

---

## Requirements

- **PHP 8.3+**
- Composer

We always encourage using the **latest PHP versions** for better performance and security.  
See [supported PHP versions](https://www.php.net/supported-versions.php) and [what's new](https://php.watch/versions).

---

## Installation

You can install the package via Composer:

```bash
composer require lloricode/paymaya-sdk-php
```

> **Upgrading from v2?** Check the [Upgrade Guide](UPGRADING.md).

---

## Upgrading from v2 to v3

We have introduced **breaking changes** in v3, including:
- PHP 8.3 requirement
- Switch to [Saloon](https://docs.saloon.dev/) for HTTP requests
- DTOs and Enums for better type safety
- Unified `PaymayaConnector` instead of multiple clients

➡ **See full details in the [Upgrade Guide](UPGRADING.md).**

---

## Laravel Integration

If you're using **Laravel**, we recommend installing the official Laravel package for a seamless experience:

```bash
composer require lloricode/laravel-paymaya-sdk
```

This package provides:
- **Service Provider & Facade** for easy access
- **Configuration file** for managing API keys and environment
- **Laravel-specific helpers** for better developer experience

📘 Learn more here: [Laravel PayMaya SDK](https://github.com/lloricode/laravel-paymaya-sdk)

---

## Usage

Below are common usage examples.  
Refer to [PayMaya API Docs](https://developers.maya.ph/reference) for full details.

---

### Checkout
https://developers.maya.ph/reference/createv1checkout
``` php
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
use Lloricode\Paymaya\Paymaya;

$api = new Paymaya(
    environment: Environment::Sandbox,
    secretKey: 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl',
    publicKey: 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah',
);

$checkout = new CheckoutDto(
    totalAmount: new TotalAmountDto(
        value: 100,
        details: new AmountDetailDto(
            subtotal: 100
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
            email: 'merchant@merchantsite.com'
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
            shippingType: 'ST'
        ),
        billingAddress: new BillingAddressDto(
            line1: '6F Launchpad',
            line2: 'Reliance Street',
            city: 'Mandaluyong City',
            state: 'Metro Manila',
            zipCode: '1552',
            countryCode: 'PH'
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
                    subtotal: 100
                )
            ),
            totalAmount: new AmountDto(
                value: 100,
                details: new AmountDetailDto(
                    discount: 0,
                    serviceCharge: 0,
                    shippingFee: 0,
                    tax: 0,
                    subtotal: 100
                )
            )
        ),
    ],
    redirectUrl: new RedirectUrlDto(
        success: 'https://www.merchantsite.com/success',
        failure: 'https://www.merchantsite.com/failure',
        cancel: 'https://www.merchantsite.com/cancel'
    ),
    requestReferenceNumber: '1551191039',
    metadata: new MetaDataDto(
        smi: 'smi',
        smn: 'smn',
        mci: 'mci',
        mpc: 'mpc',
        mco: 'mco',
        mst: 'mst'
    )
);

// submit
$checkoutResponse = $api->createCheckout($checkout);

echo 'id: '.$checkoutResponse->checkoutId."\n";
echo 'url: '.$checkoutResponse->redirectUrl."\n";

// retrieve
$checkoutDto = $api->getCheckout($checkoutResponse->checkoutId);
```

### Customization
https://developers.maya.ph/reference/setv1customizations-1
```php
use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Paymaya;

$api = new Paymaya(
    environment: Environment::Sandbox,
    secretKey: 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl',
    publicKey: 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah',
);

// register (readonly DTO via constructor)
$api->createCustomization(
    new CustomizationDto(
        logoUrl: 'https://image-logo.png',
        iconUrl: 'https://image-icon.png',
        appleTouchIconUrl: 'https://image-apple.png',
        customTitle: 'Test Title Mock',
        colorScheme: '#e01c44',
    )
);

// retrieve
$customizationDto = $api->customizations();

// delete
$api->deleteCustomization();
```

### Webhook

#### Checkout Webhook
https://developers.maya.ph/reference/createv1webhook-1
```php
use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Enums\Webhook;
use Lloricode\Paymaya\Paymaya;

$api = new Paymaya(
    environment: Environment::Sandbox,
    secretKey: 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl',
    publicKey: 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah',
);

// retrieve
/** @var array<string, WebhookDto> $webhooks */
$webhooks = $api->webhooks();

// delete all
foreach ($webhooks as $webhook) {
    $api->deleteWebhook($webhook->id);
}

// register (readonly DTOs via constructors)
$createdWebhookDto = $api->createWebhook(
    new WebhookDto(
        name: Webhook::CHECKOUT_SUCCESS,
        callbackUrl: 'https://web.test/test/success'
    )
);

// update (create a new readonly DTO with the existing id and new callback URL)
$existing = $webhooks[Webhook::CHECKOUT_SUCCESS];
$updatingDto = new WebhookDto(
    id: $existing->id,
    name: $existing->name,
    callbackUrl: 'https://web.test/test/update-success'
);

$webhookDto = $api->updateWebhooks($updatingDto);
```
---

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

---

## Changelog

See [CHANGELOG](CHANGELOG.md) for details.

---

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for guidelines.

---

## Security

Please review [our security policy](../../security/policy) for details.

---

## Credits

- [Lloric Mayuga Garcia](https://github.com/lloricode)
- [All Contributors](../../contributors)

---

## License

The MIT License (MIT). See [LICENSE](LICENSE.md) for more information.
