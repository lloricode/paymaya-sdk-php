# Upgrade Guide

This document contains upgrade instructions for breaking changes in each major release.

---

## TL;DR – Breaking Changes in v3

- **PHP 8.3+ required** (previously 8.2)
- **Uses [Saloon](https://docs.saloon.dev/) instead of direct Guzzle usage**
- **Removed multiple clients (`CheckoutClient`, `WebhookClient`, etc.)**
    - Use **`PaymayaConnector`** + **Request classes**
- **Introduced Enums** (`Environment::Sandbox` instead of string constants)
- **Introduced DTOs** for request payloads (instead of raw arrays)
- **Internal structure reorganized**:
    - `Enums/`, `DataTransferObjects/`, `Requests/`
- **Error handling via Saloon exceptions**
- **Laravel users should install [`lloricode/laravel-paymaya-sdk`](https://github.com/lloricode/laravel-paymaya-sdk)**

---

## v3.x (from v2.x)

Version 3 introduces **breaking changes** to improve code structure, type safety, and developer experience.

### Why v3?

- **Simplified API calls** using a single `PaymayaConnector` instead of multiple clients.
- **DTO-based requests** for better type safety and maintainability.
- **Enum support** for standardized values (like environment, status, etc.).
- **Modern PHP features** (typed properties, readonly, enums).
- **Adopts [Saloon](https://docs.saloon.dev/)** for HTTP requests (Saloon is built on top of Guzzle).
- **Reorganized internal structure** for better maintainability:
    - `Enums` for constants
    - `DataTransferObjects` for typed payloads
    - `Requests` for Saloon-powered requests

---

### Minimum Requirements

| Requirement    | v2         | v3         |
|---------------|-----------|-----------|
| PHP Version   | ^8.2      | ^8.3      |
| HTTP Layer    | `guzzlehttp/guzzle` | `saloonphp/saloon` (uses Guzzle under the hood) |

---

### Why PHP 8.3?

- **Active Support** – PHP 8.3 is still under **active support**, not just security fixes.
- **Reduced Maintenance Complexity** – Dropping older PHP versions simplifies the codebase, avoiding polyfills or backward compatibility hacks.
- **Modern Features** – We take advantage of the latest language features such as:
    - **Readonly properties**
    - **Enums**
    - **Improved type safety**
- **Future-Proof** – Encourages developers to adopt the latest technologies for long-term sustainability.

---

### Major Changes

#### Initialization

**Before (v2):**
```php
$checkout = (new Checkout())
    ->setTotalAmount(
        (new TotalAmount())
            ->setValue(100) // ...
    ) // ...
    
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

**Now (v3):**
```php
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
    ), // ...
    
$checkoutResponse = $api->send(new CreateCheckoutRequest($checkout))->dto();

echo 'id: '.$checkoutResponse->checkoutId."\n";
echo 'url: '.$checkoutResponse->redirectUrl."\n";
```

---

#### Removed Multiple Clients
- **Removed:** `CheckoutClient`, `CustomizationClient`, `WebhookClient`, `PaymayaClient`, etc.
- **Use instead:** `PaymayaConnector` + specific Request classes like:
    - `CreateCheckoutRequest`
    - `GetCheckoutRequest`
    - `CreateWebhookRequest`

---

#### Request & Response Handling
- v2 used **arrays** for payloads.
- v3 uses **DTO objects** for better structure and type safety.

**Old (v2):**
```php
$checkout = (new Checkout())
    ->setTotalAmount(
        // ...
    )
    ->setBuyer(
        // ...
    )
    ->addItem(
        // ...
    )
    ->setRedirectUrl(
        // ...
    )
    ->setRequestReferenceNumber('1551191039')
    ->setMetadata(
       // ...
    );
```

**New (v3):**
```php
$checkout = new CheckoutDto(
    totalAmount: new TotalAmountDto(
        value: 100,
        details: new AmountDetailDto(
            subtotal: 100
        )
    ),
    buyer: // ...
    items: // ...
    redirectUrl: // ...
    requestReferenceNumber: '1551191039',
    metadata: // ...
);
```

---

#### Environment & Config
- **Old:**
```php
Environment::SANDBOX;
```
- **New:**
```php
Environment::Sandbox; // Enum case
```

---

### Error Handling

**Before:**
- Errors returned as arrays or Guzzle exceptions.

**Now:**
- Errors throw `RequestException` from Saloon.
- Use `try...catch`:

```php
try {
    $response = $connector->send($request);
} catch (\Saloon\Exceptions\Request\RequestException $e) {
    // Handle API error
}
```

---

### Laravel Users

If you are building a Laravel application, install the Laravel integration package:

```bash
composer require lloricode/laravel-paymaya-sdk
```

This package provides:
- Auto configuration through Laravel service provider
- Facades for quick access
- Config file publishing

See [Laravel PayMaya SDK](https://github.com/lloricode/laravel-paymaya-sdk) for usage.

---

### Old → New Class & Method Mapping

| v2 Class / Method                             | v3 Replacement                              |
|-----------------------------------------------|---------------------------------------------|
| `CheckoutClient::execute() + PaymayaClient`   | `PaymayaConnector + CreateCheckoutRequest` |
| `CheckoutClient::retrieve() + PaymayaClient`  | `PaymayaConnector + GetCheckoutRequest`    |
| `WebhookClient::register() + PaymayaClient`   | `PaymayaConnector + CreateWebhookRequest`  |
| `WebhookClient::retrieve() + PaymayaClient`   | `PaymayaConnector + GetAllWebhookRequest`    |
| `PaymayaClient::ENVIRONMENT_SANDBOX`          | `Environment::Sandbox` (Enum)             |
| `PaymayaClient::ENVIRONMENT_PRODUCTION`       | `Environment::Production` (Enum)          |

---

## Future Upgrade Policy

We aim to **always support the latest PHP versions** to:
- Reduce technical debt
- Take advantage of new language features
- Encourage modern development practices
- Ensure long-term compatibility and maintainability

If you plan to contribute, please make sure to:
- Follow the current PHP minimum version requirement
- Prefer modern syntax and features whenever possible

### Check PHP Active Support

- [PHP Supported Versions](https://www.php.net/supported-versions.php)
- [PHP Version Changes & Features](https://php.watch/versions)

---

## References
- [Full Documentation](https://github.com/lloricode/paymaya-sdk-php)
- [Saloon Documentation](https://docs.saloon.dev/)
- [Laravel Integration](https://github.com/lloricode/laravel-paymaya-sdk)
