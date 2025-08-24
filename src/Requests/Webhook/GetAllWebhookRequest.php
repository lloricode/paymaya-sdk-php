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

        //        try {
        $data = $response->array();
        //        }catch (GuzzleException $e) {
        //            if ($e->getCode() === 404) {
        //                return [];
        //            }
        //
        //        }

        $array = [];
        foreach ($data as $value) {
            $array[$value['name']] = new WebhookDto(...$value);
        }

        return $array;
    }
}
