<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Amount;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * @method self setDiscount(float|int|string $discount)
 * @method self setServiceCharge(float|int|string $serviceCharge)
 * @method self setShippingFee(float|int|string $shippingFee)
 * @method self setTax(float|int|string $tax)
 * @method self setSubtotal(float|int|string $subtotal)
 */
class AmountDetailDto extends BaseDto
{
    public function __construct(
        public float|int|string $discount = 0,
        public float|int|string $serviceCharge = 0,
        public float|int|string $shippingFee = 0,
        public float|int|string $tax = 0,
        public float|int|string $subtotal = 0,
    ) {}
}
