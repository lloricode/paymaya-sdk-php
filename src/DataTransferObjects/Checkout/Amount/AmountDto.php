<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Amount;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class AmountDto extends BaseDto
{
    public function __construct(
        public float $value = 0.0,
        public AmountDetailDto $details = new AmountDetailDto
    ) {}
}
