<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\BaseRequest;

class AmountDetailRequest extends BaseRequest
{
    private float $discount = 0;
    private float $service_charge = 0;
    private float $shipping_fee = 0;
    private float $tax = 0;
    private float $subtotal = 0;

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function setServiceCharge(float $serviceCharge): self
    {
        $this->service_charge = $serviceCharge;

        return $this;
    }

    public function setShippingFee(float $shippingFee): self
    {
        $this->shipping_fee = $shippingFee;

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
            'serviceCharge' => $this->service_charge,
            'shippingFee' => $this->shipping_fee,
            'tax' => $this->tax,
            'subtotal' => $this->subtotal,
        ];
    }
}
