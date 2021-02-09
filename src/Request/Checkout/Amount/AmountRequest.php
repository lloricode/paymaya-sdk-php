<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\BaseRequest;

class AmountRequest extends BaseRequest
{
    public float $value = 0.0;
    public AmountDetailRequest $details;

    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'details', AmountDetailRequest::class);
        self::toFloat($parameters, 'value');

        parent::__construct($parameters);
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setDetails(AmountDetailRequest $details): self
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'details' => $this->details,
        ];
    }
}
