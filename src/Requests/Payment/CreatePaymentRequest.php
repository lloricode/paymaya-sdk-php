<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Payment;

use Lloricode\Paymaya\Response\Payment\Create\PaymentResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class CreatePaymentRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/payments/v1/payments/$this->id";
    }

    public function createDtoFromResponse(Response $response): PaymentResponse
    {
        return PaymentResponse::fromArray($response->array());
    }
}
