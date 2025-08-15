<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDetailDto;

/**
 * @method self setValue(float $value)
 * @method self setDetails(AmountDetailDto $details)
 * @method self setCurrency(string $string)
 * @method self setAmount(float|int|string $amount)
 */
class TotalAmountDto extends BaseDto
{
    public function __construct(
        public string $currency = 'PHP',
        public float|int|string $amount = 0,
        public float $value = 0.0,
        public ?AmountDetailDto $details = null,
    ) {
        $this->details ??= new AmountDetailDto;
    }
}
