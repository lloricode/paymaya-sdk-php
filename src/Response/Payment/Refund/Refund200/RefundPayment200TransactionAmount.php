<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Refund\Refund200;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class RefundPayment200TransactionAmount extends BaseResponse
{
    public function __construct(
        public float $value,
        public string $currency,
    ) {}
}
