<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Amount;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * @method self setValue(float $value)
 * @method self setDetails(AmountDetailDto $details)
 */
class AmountDto extends BaseDto
{
    public function __construct(
        public float $value = 0.0,
        public ?AmountDetailDto $details = null
    ) {
        $this->details ??= new AmountDetailDto;
    }
}
