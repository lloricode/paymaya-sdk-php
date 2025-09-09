<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Concerns;

use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentRefundDto;
use Lloricode\Paymaya\Requests\Payment\PaymentRefundRequest;
use Lloricode\Paymaya\Requests\Payment\RetrievePaymentRequest;
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
        /** @var RefundPayment200Response|RefundPayment202Response $dto */
        $dto = $this->send(new PaymentRefundRequest($id, $paymentRefund))->dto();

        return $dto;
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function getPayment(string $id): PaymentResponse
    {
        /** @var PaymentResponse $dto */
        $dto = $this->send(new RetrievePaymentRequest($id))->dto();

        return $dto;
    }
}
