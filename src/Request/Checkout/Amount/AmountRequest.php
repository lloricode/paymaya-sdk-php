<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\BaseRequest;

class AmountRequest extends BaseRequest
{
    private float $value = 0.0;
    private AmountDetailRequest $amount_request;

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setAmountRequest(AmountDetailRequest $amountRequest): self
    {
        $this->amount_request = $amountRequest;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'details' => $this->amount_request,
        ];
    }
}
