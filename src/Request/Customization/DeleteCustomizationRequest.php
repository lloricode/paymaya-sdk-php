<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Customization;

use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasJsonBody;

class DeleteCustomizationRequest extends SoloRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/customizations';
    }

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithSecretKey();
    }
}
