<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * @method self setLine1(string $line1)
 * @method self setLine2(string $line2)
 * @method self setCity(string $city)
 * @method self setState(string $state)
 * @method self setZipCode(string $zipCode)
 * @method self setCountryCode(string $countryCode)
 */
class BillingAddressDto extends BaseDto
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
