<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Customization;

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * https://developers.maya.ph/reference/getv1customizations-1
 */
class RetrieveCustomizationRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'payments/v1/customizations';
    }

    public function createDtoFromResponse(Response $response): CustomizationDto
    {
        return new CustomizationDto(...$response->array());
    }
}
