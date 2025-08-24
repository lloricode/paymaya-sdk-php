<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Customization;

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * https://developers.maya.ph/reference/setv1customizations-1
 */
class RegisterCustomizationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly CustomizationDto $customizationDto) {}

    public function resolveEndpoint(): string
    {
        return 'payments/v1/customizations';
    }

    protected function defaultBody(): array
    {
        return (array) $this->customizationDto;
    }

    public function createDtoFromResponse(Response $response): CustomizationDto
    {
        return new CustomizationDto(...$response->array());
    }
}
