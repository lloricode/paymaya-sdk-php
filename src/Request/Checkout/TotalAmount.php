<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;

/**
 * @method TotalAmount setValue(float $value)
 * @method TotalAmount setDetails(AmountDetail $details)
 * @method TotalAmount setCurrency(string $string)
 * @method TotalAmount setAmount(float $amount)
 */
class TotalAmount extends Base
{
    public string $currency = 'PHP';
    public float $amount = 0;
    public float $value = 0.0;
    public AmountDetail $details;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'details', AmountDetail::class);
        self::toFloat($parameters, 'value');
        self::toFloat($parameters, 'amount');

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
            'currency' => $this->currency,
        ];
    }
}
