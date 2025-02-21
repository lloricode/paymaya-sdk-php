<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;

/**
 * @method Item setName(string $name)
 * @method Item setQuantity(int $quantity)
 * @method Item setCode(string $code)
 * @method Item setDescription(string $description)
 * @method Item setAmount(Amount $amount)
 * @method Item setTotalAmount(Amount $totalAmount)
 */
class Item extends Base
{
    public function __construct(
        public ?string $name = null,
        public int $quantity = 1,
        public ?string $code = null,
        public ?string $description = null,
        public ?Amount $amount = null,
        public ?Amount $totalAmount = null,
    ) {
        $this->amount ??= new Amount;
        $this->totalAmount ??= new Amount;
    }
}
