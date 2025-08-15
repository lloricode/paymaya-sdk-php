<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Customization;

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasJsonBody;

class RetrieveCustomizationRequest extends SoloRequest implements HasBody
{
    use HasJsonBody;

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
