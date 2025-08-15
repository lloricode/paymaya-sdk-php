<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * @method self setPhone(string $string)
 * @method self setEmail(string $email)
 */
class ContactDto extends BaseDto
{
    public function __construct(
        public ?string $phone = null,
        public ?string $email = null
    ) {}
}
