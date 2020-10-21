<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Checkout\Amount\AmountRequest;

class TotalAmountRequest extends AmountRequest
{
    private string $currency = 'PHP';

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
                'currency' => $this->currency,
            ] + parent::jsonSerialize();
    }
}
