<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Webhook;

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * https://developers.maya.ph/reference/updatev1webhook-1
 */
class UpdateWebhookRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        private readonly WebhookDto $webhookDto
    ) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/webhooks/'.($this->webhookDto->id ?? throw new \InvalidArgumentException('Webhook ID is required'));
    }

    protected function defaultBody(): array
    {
        return (array) $this->webhookDto;
    }

    public function createDtoFromResponse(Response $response): WebhookDto
    {
        return new WebhookDto(...$response->array());
    }
}
