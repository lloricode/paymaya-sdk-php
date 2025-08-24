<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use Exception;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Requests\Checkout\CreateCheckoutRequest;
use Lloricode\Paymaya\Requests\Checkout\GetCheckoutRequest;
use Lloricode\Paymaya\Requests\Customization\RemoveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\SetCustomizationRequest;
use Lloricode\Paymaya\Requests\Webhook\CreateWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\GetAllWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\PendingRequest;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\HasTimeout;

class PaymayaConnector extends Connector
{
    use AcceptsJson;
    use HasTimeout;

    protected int $connectTimeout = 60;

    protected int $requestTimeout = 120;

    public function __construct(
        private readonly Environment $environment,
        private readonly string $secretKey,
        private readonly string $publicKey,
    ) {}

    public function boot(PendingRequest $pendingRequest): void
    {
        $token = match ($pendingRequest->getRequest()::class) {
            GetCheckoutRequest::class ,
            RemoveCustomizationRequest::class,
            SetCustomizationRequest::class,
            RetrieveCustomizationRequest::class,
            DeleteWebhookRequest::class,
            CreateWebhookRequest::class,
            GetAllWebhookRequest::class,
            UpdateWebhookRequest::class => $this->secretKey,
            CreateCheckoutRequest::class => $this->publicKey,
            default => throw new Exception('Request ['.$pendingRequest->getRequest()::class.'] not found for getting token type.'),
        };

        $pendingRequest->authenticate(new TokenAuthenticator(base64_encode($token), 'Basic'));
    }

    public function resolveBaseUrl(): string
    {
        return $this->environment->url();
    }
}
