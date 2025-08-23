<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class BuyerDto extends BaseDto
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
