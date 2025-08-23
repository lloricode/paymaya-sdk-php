<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDto;

readonly class ItemDto extends BaseDto
{
    public function __construct(
        public ?string $name = null,
        public int $quantity = 1,
        public ?string $code = null,
        public ?string $description = null,
        public AmountDto $amount = new AmountDto,
        public AmountDto $totalAmount = new AmountDto,
    ) {}
}
