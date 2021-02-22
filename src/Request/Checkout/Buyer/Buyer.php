<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setFirstName(string $firstName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setMiddleName(string $middleName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setLastName(string $lastName)
 *
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setBirthday(Carbon $birthday)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Buyer setCustomerSince(Carbon $customerSince)
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
    public ?string $firstName = null;
    public ?string $middleName = null;
    public ?string $lastName = null;

    public ?Carbon $birthday = null;
    public ?Carbon $customerSince = null;
    public ?string $gender = null;

    public ?Contact $contact = null;
    public ?ShippingAddress $shippingAddress = null;
    public ?BillingAddress $billingAddress = null;

    private ?string $ipAddress = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $birthday = $this->birthday;
        $customerSince = $this->customerSince;

        if (! is_null($birthday)) {
            $birthday = $birthday->format('Y-m-d');
        }

        if (! is_null($customerSince)) {
            $customerSince = $customerSince->format('Y-m-d');
        }

        return [
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'birthday' => $birthday,
            'customerSince' => $customerSince,
            'sex' => $this->gender,
            'contact' => $this->contact,
            'shippingAddress' => $this->shippingAddress,
            'billingAddress' => $this->billingAddress,
            'ipAddress' => $this->ipAddress,
        ];
    }
}
