<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Customization;

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;

class RetrieveCustomizationRequest extends SoloRequest
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/customizations';
    }

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithSecretKey();
    }

    public function createDtoFromResponse(Response $response): CustomizationDto
    {
        return new CustomizationDto(...$response->array());
    }
}
