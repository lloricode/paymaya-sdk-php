<?php

declare(strict_types=1);

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

    /** @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties */
    public function __construct(mixed ...$args)
    {
        self::setClassIfKeyNotExist($args, 'details', AmountDetail::class);

        parent::__construct(...$args);
    }

    /** @inheritDoc */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value,
            'details' => $this->details,
            'currency' => $this->currency,
        ];
    }
}
