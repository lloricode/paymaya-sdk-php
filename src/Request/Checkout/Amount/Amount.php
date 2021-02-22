<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\Amount setValue(float $value)
 * @method \Lloricode\Paymaya\Request\Checkout\Amount\Amount setDetails(AmountDetail $details)
 */
class Amount extends Base
{
    public float $value = 0.0;
    public AmountDetail $details;

    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'details', AmountDetail::class);
        self::toFloat($parameters, 'value');

        parent::__construct($parameters);
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
