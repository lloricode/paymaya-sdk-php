<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Payment;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class PaymentRefundDto extends BaseDto
{
    public function __construct(
        public string $reason,
        public PaymentTotalAmountDto $totalAmount,
    ) {}
}
