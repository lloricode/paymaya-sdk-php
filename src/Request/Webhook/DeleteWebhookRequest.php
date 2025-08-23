<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Webhook;

use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\SoloRequest;

class DeleteWebhookRequest extends SoloRequest
{
    protected Method $method = Method::DELETE;

    public function __construct(private readonly string $webhookId) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/webhooks/'.$this->webhookId;
    }

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithSecretKey();
    }
}
