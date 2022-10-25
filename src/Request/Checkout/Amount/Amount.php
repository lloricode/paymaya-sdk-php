<?php

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\Base;

/**
 * @method Amount setValue(float $value)
 * @method Amount setDetails(AmountDetail $details)
 */
class Amount extends Base
{
    public float $value = 0.0;
    public AmountDetail $details;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'details', AmountDetail::class);

        parent::__construct($parameters);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value,
            'details' => $this->details,
        ];
    }
}
