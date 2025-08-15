<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * @method self setFirstName(string $firstName)
 * @method self setMiddleName(string $middleName)
 * @method self setLastName(string $lastName)
 * @method self setBirthday(string $birthday)
 * @method self setCustomerSince(string $customerSince)
 * @method self setGender(string $gender)
 * @method self setContact(ContactDto $contact)
 * @method self setShippingAddress(ShippingAddressDto $shippingAddress)
 * @method self setBillingAddress(BillingAddressDto $billingAddress)
 * @method self setIpAddress(string $ipAddress)
 */
class BuyerDto extends BaseDto
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $middleName = null,
        public ?string $lastName = null,
        public ?string $birthday = null,
        public ?string $customerSince = null,
        public ?string $gender = null,
        public ?ContactDto $contact = null,
        public ?ShippingAddressDto $shippingAddress = null,
        public ?BillingAddressDto $billingAddress = null,
        public ?string $ipAddress = null
    ) {}
}
