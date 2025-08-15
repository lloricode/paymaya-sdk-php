<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\PaymayaConnector;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasJsonBody;

class SubmitCheckoutRequest extends SoloRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly CheckoutDto $checkoutDto) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/checkouts';
    }

    protected function defaultBody(): array
    {
        return $this->checkoutDto->toArray();
    }

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithPublicKey();
    }

    public function createDtoFromResponse(Response $response): CheckoutResponse
    {
        return new CheckoutResponse(...$response->array());
    }
}
