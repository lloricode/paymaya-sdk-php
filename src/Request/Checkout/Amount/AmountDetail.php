<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\Base;

/**
 * @method AmountDetail setDiscount(float $discount)
 * @method AmountDetail setServiceCharge(float $serviceCharge)
 * @method AmountDetail setShippingFee(float $shippingFee)
 * @method AmountDetail setTax(float $tax)
 * @method AmountDetail setSubtotal(float $subtotal)
 */
class AmountDetail extends Base
{
    public float $discount = 0;
    public float $serviceCharge = 0;
    public float $shippingFee = 0;
    public float $tax = 0;
    public float $subtotal = 0;

    /** @inheritDoc */
    public function jsonSerialize(): array
    {
        return [
            'discount' => $this->discount,
            'serviceCharge' => $this->serviceCharge,
            'shippingFee' => $this->shippingFee,
            'tax' => $this->tax,
            'subtotal' => $this->subtotal,
        ];
    }
}
