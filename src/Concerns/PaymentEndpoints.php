<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Concerns;

use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentRefundDto;
use Lloricode\Paymaya\Requests\Payment\CreatePaymentRequest;
use Lloricode\Paymaya\Requests\Payment\PaymentRefundRequest;
use Lloricode\Paymaya\Response\Payment\Create\PaymentResponse;
use Lloricode\Paymaya\Response\Payment\Refund\RefundPayment200Response;
use Lloricode\Paymaya\Response\Payment\Refund\RefundPayment202Response;

/** @mixin \Lloricode\Paymaya\Paymaya */
trait PaymentEndpoints
{
    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function paymentRefund(string $id, PaymentRefundDto $paymentRefund): RefundPayment200Response|RefundPayment202Response
    {
        return $this->send(new PaymentRefundRequest($id, $paymentRefund))->dto();
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function createPayment(string $id): PaymentResponse
    {
        return $this->send(new CreatePaymentRequest($id))->dto();
    }
}
