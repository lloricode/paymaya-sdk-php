<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount\Amount;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\Payer;

class EFS extends BaseResponse
{
    public function __construct(
        public string $paymentTransactionReferenceNo,
        public string $status,
        public Receipt $receipt,
        public Payer $payer,
        public Amount $amount,
        public string $created_at,
    ) {}
}
