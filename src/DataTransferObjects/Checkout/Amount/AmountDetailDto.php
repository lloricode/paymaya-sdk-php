<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Amount;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class AmountDetailDto extends BaseDto
{
    public function __construct(
        public float|int|string $discount = 0,
        public float|int|string $serviceCharge = 0,
        public float|int|string $shippingFee = 0,
        public float|int|string $tax = 0,
        public float|int|string $subtotal = 0,
    ) {}
}
