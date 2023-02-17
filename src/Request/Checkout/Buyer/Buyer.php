<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setFirstName(string $firstName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setMiddleName(string $middleName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setLastName(string $lastName)
 *
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setBirthday(string $birthday)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setCustomerSince(string $customerSince)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setGender(string $gender)
 *
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setContact(Contact $contact)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setShippingAddress(ShippingAddress $shippingAddress)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setBillingAddress(BillingAddress $billingAddress)
 *
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setIpAddress(string $ipAddress)
 */
class Buyer extends Base
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $middleName = null,
        public ?string $lastName = null,
        public ?string $birthday = null,
        public ?string $customerSince = null,
        public ?string $gender = null,
        public ?Contact $contact = null,
        public ?ShippingAddress $shippingAddress = null,
        public ?BillingAddress $billingAddress = null,
        public ?string $ipAddress = null
    ) {
    }
}
