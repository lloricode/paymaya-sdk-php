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
 * https://developers.maya.ph/reference/createv1webhook-1
 */
class RegisterWebhookRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly WebhookDto $webhookDto) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/webhooks';
    }

    protected function defaultBody(): array
    {
        return (array) $this->webhookDto;
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
