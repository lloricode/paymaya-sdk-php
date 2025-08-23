<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests;

use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\PaymayaConnector;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Http\SoloRequest;

class RetrieveCheckoutRequest extends SoloRequest
{
    protected Method $method = Method::GET;

    public function __construct(private readonly string $id) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/checkouts/'.$this->id;
    }

    #[\Override]
    protected function resolveConnector(): Connector
    {
        return PaymayaConnector::makeWithSecretKey();
    }

    public function createDtoFromResponse(Response $response): CheckoutDto
    {
        return CheckoutDto::fromArray($response->array());
    }
}
