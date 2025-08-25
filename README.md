![PayMaya SDK](https://banners.beyondco.de/PayMaya%20SDK%20PHP.png?theme=light&packageManager=composer+require&packageName=lloricode%2Fpaymaya-sdk-php&pattern=architect&style=style_2&description=PayMaya+SDK+for+PHP&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Fwww.php.net%2Fimages%2Flogos%2Fnew-php-logo.svg)

# PayMaya SDK for PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![Tests](https://img.shields.io/github/actions/workflow/status/lloricode/paymaya-sdk-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/lloricode/paymaya-sdk-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/lloricode/paymaya-sdk-php.svg?style=flat-square)](https://packagist.org/packages/lloricode/paymaya-sdk-php)
[![codecov](https://codecov.io/gh/lloricode/paymaya-sdk-php/branch/main/graph/badge.svg?token=S1INCAHVSV)](https://app.codecov.io/gh/lloricode/paymaya-sdk-php/tree/main)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate?hosted_button_id=V8PYXUNG6QP44)

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/D1D71HJZD)

A modern, type-safe PayMaya SDK for PHP built on [Saloon](https://docs.saloon.dev/) for making secure and structured API calls.

---

- [Installation](#installation)
- [Usage](#usage)
    - [Checkout](#checkout)
    - [Customization](#customization)
    - [Webhooks](#webhooks)
        - [Checkout Webhook](#checkout-webhook)

---

## Installation

Install via Composer:

```bash
composer require lloricode/paymaya-sdk-php
```

---

## Usage

You can copy these examples for quick testing and integration.

---

### Checkout
[PayMaya Checkout API](https://developers.maya.ph/reference/createv1checkout)

```php
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
use Lloricode\Paymaya\Requests\Checkout\GetCheckoutRequest;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;

$api = new PaymayaConnector(
    environment: Environment::Sandbox,
    secretKey: 'sk-your-secret-key',
    publicKey: 'pk-your-public-key',
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
/** @var CheckoutResponse $checkoutResponse */
$checkoutResponse = $api->send(new CreateCheckoutRequest($checkout))->dto();

echo 'id: '.$checkoutResponse->checkoutId."\n";
echo 'url: '.$checkoutResponse->redirectUrl."\n";

// retrieve
/** @var CheckoutDto $checkoutDto */
$checkoutDto = $api->send(new GetCheckoutRequest($checkoutResponse->checkoutId))->dto();
```

---

### Customization
[Set Customization API](https://developers.maya.ph/reference/setv1customizations-1)

```php
use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\PaymayaConnector;
use Lloricode\Paymaya\Requests\Customization\RemoveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\SetCustomizationRequest;

$api = new PaymayaConnector(
    environment: Environment::Sandbox,
    secretKey: 'sk-your-secret-key',
    publicKey: 'pk-your-public-key',
);

// register
$api->send(new SetCustomizationRequest(
    new CustomizationDto(
        logoUrl: 'https://image-logo.png',
        iconUrl: 'https://image-icon.png',
        appleTouchIconUrl: 'https://image-apple.png',
        customTitle: 'Test Title Mock',
        colorScheme: '#e01c44',
    )
))->dto();

// retrieve
/** @var CustomizationDto $customizationDto */
$customizationDto = $api->send(new RetrieveCustomizationRequest)->dto();

// delete
$api->send(new RemoveCustomizationRequest);
```

---

### Webhooks

#### Checkout Webhook
[Webhook API](https://developers.maya.ph/reference/createv1webhook-1)

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
    secretKey: 'sk-your-secret-key',
    publicKey: 'pk-your-public-key',
);

// retrieve
/** @var array<string, WebhookDto> $webhooks */
$webhooks = $api->send(new GetAllWebhookRequest)->dto();

// delete all
foreach ($webhooks as $webhook) {
    $api->send(new DeleteWebhookRequest($webhook->id));
}

// register
/** @var WebhookDto $createdWebhookDto */
$createdWebhookDto = $api->send(new CreateWebhookRequest(
    new WebhookDto(
        name: Webhook::CHECKOUT_SUCCESS,
        callbackUrl: 'https://web.test/test/success'
    )
));

// update
$existing = $webhooks[Webhook::CHECKOUT_SUCCESS];
$updatingDto = new WebhookDto(
    id: $existing->id,
    name: $existing->name,
    callbackUrl: 'https://web.test/test/update-success'
);

/** @var WebhookDto $webhookDto */
$webhookDto = $api->send(new UpdateWebhookRequest($updatingDto))->dto();
```

---

## Testing

```bash
vendor/bin/phpunit
```

---

## Changelog

See [CHANGELOG](CHANGELOG.md) for recent changes.

---

## Contributing

See [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

---

## Security

See [Security Policy](../../security/policy).

---

## Credits

- [Lloric Mayuga Garcia](https://github.com/lloricode)
- [All Contributors](../../contributors)

---

## License

The MIT License (MIT). See [LICENSE](LICENSE.md) for more information.
