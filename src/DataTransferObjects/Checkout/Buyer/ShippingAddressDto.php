<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * @method self setFirstName(string $firstName)
 * @method self setMiddleName(string $middleName)
 * @method self setLastName(string $lastName)
 * @method self setPhone(string $phone)
 * @method self setEmail(string $email)
 * @method self setLine1(string $line1)
 * @method self setLine2(string $line2)
 * @method self setCity(string $city)
 * @method self setState(string $state)
 * @method self setZipCode(string $zipCode)
 * @method self setCountryCode(string $countryCode)
 * @method self setShippingType(string $shippingType)
 */
class ShippingAddressDto extends BaseDto
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $middleName = null,
        public ?string $lastName = null,
        public ?string $phone = null,
        public ?string $email = null,
        public ?string $line1 = null,
        public ?string $line2 = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $zipCode = null,
        public ?string $countryCode = null,
        public ?string $shippingType = null, // ST - for standard, SD - for same day
    ) {}
}
