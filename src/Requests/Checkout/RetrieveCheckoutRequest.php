<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Checkout;

use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveCheckoutRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly string $id) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/checkouts/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): CheckoutDto
    {
        return CheckoutDto::fromArray($response->array());
    }
}
