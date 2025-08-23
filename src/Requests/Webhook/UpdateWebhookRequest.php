<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Webhook;

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasJsonBody;

class UpdateWebhookRequest extends SoloRequest implements HasBody
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

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithSecretKey();
    }

    public function createDtoFromResponse(Response $response): WebhookDto
    {

        //        try {
        $data = $response->array();
        //        }catch (GuzzleException $e) {
        //            if ($e->getCode() === 404) {
        //                return [];
        //            }
        //
        //        }

        return new WebhookDto(...$data);
    }
}
