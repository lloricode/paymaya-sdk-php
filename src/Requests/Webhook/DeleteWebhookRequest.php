<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Webhook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * https://developers.maya.ph/reference/deletev1webhook-1
 */
class DeleteWebhookRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(private readonly string $webhookId) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/webhooks/'.$this->webhookId;
    }
}
