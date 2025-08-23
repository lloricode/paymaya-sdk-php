<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDetailDto;

readonly class TotalAmountDto extends BaseDto
{
    public function __construct(
        public string $currency = 'PHP',
        public float|int|string $amount = 0,
        public float $value = 0.0,
        public AmountDetailDto $details = new AmountDetailDto,
    ) {}
}
