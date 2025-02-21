<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout\Amount;

use Lloricode\Paymaya\Request\Base;

/**
 * @method Amount setValue(float $value)
 * @method Amount setDetails(AmountDetail $details)
 */
class Amount extends Base
{
    public function __construct(
        public float $value = 0.0,
        public ?AmountDetail $details = null
    ) {
        $this->details ??= new AmountDetail;
    }
}
