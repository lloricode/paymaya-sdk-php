<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDto;

/**
 * @method self setName(string $name)
 * @method self setQuantity(int $quantity)
 * @method self setCode(string $code)
 * @method self setDescription(string $description)
 * @method self setAmount(AmountDto $amount)
 * @method self setTotalAmount(AmountDto $totalAmount)
 */
class ItemDto extends BaseDto
{
    public function __construct(
        public ?string $name = null,
        public int $quantity = 1,
        public ?string $code = null,
        public ?string $description = null,
        public ?AmountDto $amount = null,
        public ?AmountDto $totalAmount = null,
    ) {
        $this->amount ??= new AmountDto;
        $this->totalAmount ??= new AmountDto;
    }
}
