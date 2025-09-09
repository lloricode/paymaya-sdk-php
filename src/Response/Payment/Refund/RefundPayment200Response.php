<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Refund;

use Lloricode\Paymaya\Response\BaseResponse;
use Lloricode\Paymaya\Response\Payment\Refund\Refund200\RefundPayment200Receipt;
use Lloricode\Paymaya\Response\Payment\Refund\Refund200\RefundPayment200RefundedAmount;
use Lloricode\Paymaya\Response\Payment\Refund\Refund200\RefundPayment200TransactionAmount;

readonly class RefundPayment200Response extends BaseResponse
{
    public function __construct(
        public string $paymentTransactionReferenceNo,
        public string $status,
        public string $createdAt,
        public RefundPayment200Receipt $receipt,
        public string $refundTransactionReferenceNo,
        public RefundPayment200TransactionAmount $transactionAmount,
        public RefundPayment200RefundedAmount $refundedAmount,
    ) {}

    public static function fromArray(mixed $array): self
    {
        $array['receipt'] = new RefundPayment200Receipt(
            ...$array['receipt']
        );

        $array['transactionAmount'] = new RefundPayment200TransactionAmount(
            ...$array['transactionAmount']
        );

        $array['refundedAmount'] = new RefundPayment200RefundedAmount(
            ...$array['refundedAmount']
        );

        return new self(...$array);
    }
}
