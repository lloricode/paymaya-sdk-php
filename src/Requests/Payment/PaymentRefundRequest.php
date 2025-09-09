<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Payment;

use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentRefundDto;
use Lloricode\Paymaya\Response\Payment\Refund\RefundPayment200Response;
use Lloricode\Paymaya\Response\Payment\Refund\RefundPayment202Response;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class PaymentRefundRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $id,
        private readonly PaymentRefundDto $paymentRefund
    ) {}

    public function resolveEndpoint(): string
    {
        return 'payments/v1/payments/'.$this->id.'/refunds';
    }

    protected function defaultBody(): array
    {
        return (array) $this->paymentRefund;
    }

    public function createDtoFromResponse(Response $response): RefundPayment200Response|RefundPayment202Response
    {
        return match ($response->status()) {
            200 => RefundPayment200Response::fromArray($response->array()),
            202 => RefundPayment202Response::fromArray($response->array()),
        };
    }
}
