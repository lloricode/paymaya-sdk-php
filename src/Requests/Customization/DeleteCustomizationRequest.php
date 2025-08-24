<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Customization;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteCustomizationRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/customizations';
    }
}
