<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class BillingAddressDto extends BaseDto
{
    public function __construct(
        public ?string $line1 = null,
        public ?string $line2 = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $zipCode = null,
        public ?string $countryCode = null
    ) {}
}
