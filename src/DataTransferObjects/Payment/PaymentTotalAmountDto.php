<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Payment;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class PaymentTotalAmountDto extends BaseDto
{
    public function __construct(
        public float $amount,
        public string $currency,
    ) {}
}
