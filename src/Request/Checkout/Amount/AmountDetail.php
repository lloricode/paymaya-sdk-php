<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail setDiscount(float $discount)
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail setServiceCharge(float $serviceCharge)
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail setShippingFee(float $shippingFee)
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail setTax(float $tax)
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail setSubtotal(float $subtotal)
 */
class AmountDetail extends Base
{
    public float $discount = 0;
    public float $serviceCharge = 0;
    public float $shippingFee = 0;
    public float $tax = 0;
    public float $subtotal = 0;

    public function __construct(array $parameters = [])
    {
        self::toFloat($parameters, 'discount');
        self::toFloat($parameters, 'serviceCharge');
        self::toFloat($parameters, 'shippingFee');
        self::toFloat($parameters, 'tax');
        self::toFloat($parameters, 'subtotal');

        parent::__construct($parameters);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
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
