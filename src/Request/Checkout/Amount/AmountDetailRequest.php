<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\BaseRequest;

class AmountDetailRequest extends BaseRequest
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

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function setServiceCharge(float $serviceCharge): self
    {
        $this->serviceCharge = $serviceCharge;

        return $this;
    }

    public function setShippingFee(float $shippingFee): self
    {
        $this->shippingFee = $shippingFee;

        return $this;
    }

    public function setTax(float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function setSubtotal(float $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
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
