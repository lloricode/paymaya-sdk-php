<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use Exception;
use Lloricode\Paymaya\Enums\Environment;
use Lloricode\Paymaya\Requests\Checkout\RetrieveCheckoutRequest;
use Lloricode\Paymaya\Requests\Checkout\SubmitCheckoutRequest;
use Lloricode\Paymaya\Requests\Customization\DeleteCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RegisterCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\RegisterWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\RetrieveWebhookRequest;
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
            RetrieveCheckoutRequest::class ,
            DeleteCustomizationRequest::class,
            RegisterCustomizationRequest::class,
            RetrieveCustomizationRequest::class,
            DeleteWebhookRequest::class,
            RegisterWebhookRequest::class,
            RetrieveWebhookRequest::class,
            UpdateWebhookRequest::class => $this->secretKey,
            SubmitCheckoutRequest::class => $this->publicKey,
            default => throw new Exception('Request ['.$pendingRequest->getRequest()::class.'] not found for getting token type.'),
        };

        $pendingRequest->authenticate(new TokenAuthenticator(base64_encode($token), 'Basic'));
    }

    public function resolveBaseUrl(): string
    {
        return $this->environment->url();
    }
}
