<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\Base;

/**
 * @method AmountDetail setDiscount(float|int|string $discount)
 * @method AmountDetail setServiceCharge(float|int|string $serviceCharge)
 * @method AmountDetail setShippingFee(float|int|string $shippingFee)
 * @method AmountDetail setTax(float|int|string $tax)
 * @method AmountDetail setSubtotal(float|int|string $subtotal)
 */
class AmountDetail extends Base
{
    public function __construct(
        public float|int|string $discount = 0,
        public float|int|string $serviceCharge = 0,
        public float|int|string $shippingFee = 0,
        public float|int|string $tax = 0,
        public float|int|string $subtotal = 0,
    ) {
    }
}
