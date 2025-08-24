<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Customization;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * https://developers.maya.ph/reference/deletev1customizations-1
 */
class DeleteCustomizationRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return 'payments/v1/customizations';
    }
}
