<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;

/**
 * @method TotalAmount setValue(float $value)
 * @method TotalAmount setDetails(AmountDetail $details)
 * @method TotalAmount setCurrency(string $string)
 * @method TotalAmount setAmount(float|int|string $amount)
 */
class TotalAmount extends Base
{
    public function __construct(
        public string $currency = 'PHP',
        public float|int|string $amount = 0,
        public float $value = 0.0,
        public ?AmountDetail $details = null,
    ) {
        $this->details ??= new AmountDetail;
    }
}
