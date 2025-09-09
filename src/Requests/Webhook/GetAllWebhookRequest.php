<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Webhook;

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * https://developers.maya.ph/reference/getv1webhooks-1
 */
class GetAllWebhookRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/webhooks';
    }

    /**
     * @return array<string, WebhookDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var list<array{id:string|null, name:string|null, callbackUrl:string|null, createdAt:string|null, updatedAt:string|null}> $array */
        $array = $response->array();

        $return = [];
        foreach ($array as $value) {

            $return[$value['name']] = new WebhookDto(...$value);
        }

        return $return;
    }
}
