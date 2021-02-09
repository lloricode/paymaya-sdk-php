<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Checkout\Amount\AmountRequest;

class TotalAmountRequest extends AmountRequest
{
    public string $currency = 'PHP';
    public float $amount = 0;

    public function __construct(array $parameters = [])
    {
        self::toFloat($parameters, 'amount');

        parent::__construct($parameters);
    }

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
