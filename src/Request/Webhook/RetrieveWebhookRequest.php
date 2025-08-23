<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Webhook;

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;

class RetrieveWebhookRequest extends SoloRequest
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/webhooks';
    }

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithSecretKey();
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
