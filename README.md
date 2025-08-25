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
use Lloricode\Paymaya\PaymayaConnector;
use Lloricode\Paymaya\Requests\Checkout\CreateCheckoutRequest;
use Lloricode\Paymaya\Requests\Checkout\RetrieveCheckoutRequest;

$api = new PaymayaConnector(
    environment: Environment::sandbox,
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
$checkoutResponse = $api->send(new CreateCheckoutRequest($checkout))->dto();

echo 'id: '.$checkoutResponse->checkoutId."\n";
echo 'url: '.$checkoutResponse->redirectUrl."\n";

// retrieve
$api->send(new RetrieveCheckoutRequest($checkoutResponse->checkoutId))->dto();

```

### Customization

```php

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\PaymayaConnector;
use Lloricode\Paymaya\Requests\Customization\RemoveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\SetCustomizationRequest;

$api = new PaymayaConnector(
    environment: Environment::Sandbox,
    secretKey: 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl',
    publicKey: 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah',
);

// register (readonly DTO via constructor)
$api->send(new SetCustomizationRequest(
    new CustomizationDto(
        logoUrl: 'https://image-logo.png',
        iconUrl: 'https://image-icon.png',
        appleTouchIconUrl: 'https://image-apple.png',
        customTitle: 'Test Title Mock',
        colorScheme: '#e01c44',
    )
))
    ->dto();

// retrieve
$api->send(new RetrieveCustomizationRequest)->dto();

// delete
$api->send(new RemoveCustomizationRequest);

```

### Webhook

#### Checkout Webhook

```php

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Enums\Webhook;
use Lloricode\Paymaya\PaymayaConnector;
use Lloricode\Paymaya\Requests\Webhook\CreateWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\GetAllWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;

$api = new PaymayaConnector(
    environment: Environment::Sandbox,
    secretKey: 'sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl',
    publicKey: 'pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah',
);

// retrieve
/** @var array<string, WebhookDto> $webhooks */
$webhooks = $api->send(new GetAllWebhookRequest)->dto();

// delete all
foreach ($webhooks as $webhook) {
    $api->send(new DeleteWebhookRequest($webhook->id));
}

// register (readonly DTOs via constructors)
$api->send(new CreateWebhookRequest(
    new WebhookDto(
        name: Webhook::CHECKOUT_SUCCESS,
        callbackUrl: 'https://web.test/test/success'
    )
));

$api->send(new CreateWebhookRequest(
    new WebhookDto(
        name: Webhook::CHECKOUT_FAILURE,
        callbackUrl: 'https://web.test/test/failure'
    )
));

$api->send(new CreateWebhookRequest(
    new WebhookDto(
        name: Webhook::CHECKOUT_DROPOUT,
        callbackUrl: 'https://web.test/test/drop'
    )
));

// update (create a new readonly DTO with the existing id and new callback URL)
$existing = $webhooks[Webhook::CHECKOUT_SUCCESS];
$updatedDto = new WebhookDto(
    id: $existing->id,
    name: $existing->name,
    callbackUrl: 'https://web.test/test/update-success'
);

$webhooks = $api->send(new UpdateWebhookRequest($updatedDto))
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
