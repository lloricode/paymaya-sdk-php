<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\Base;

class Buyer extends Base
{
    public ?string $firstName = null;
    public ?string $middleName = null;
    public ?string $lastName = null;

    public ?Carbon $birthday = null;
    public ?Carbon $customer_since = null;
    public ?string $gender = null;

    public ?Contact $contact = null;
    public ?ShippingAddress $shippingAddress = null;
    public ?BillingAddress $billingAddress = null;

    private ?string $ipAddress = null;

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setMiddleName(?string $firstMiddleName): self
    {
        $this->middleName = $firstMiddleName;

        return $this;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setBirthday(?Carbon $birthDate): self
    {
        $this->birthday = $birthDate;

        return $this;
    }

    public function setCustomerSince(?Carbon $customerSince): self
    {
        $this->customer_since = $customerSince;

        return $this;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function setContact(?Contact $contactRequest): self
    {
        $this->contact = $contactRequest;

        return $this;
    }

    public function setShippingAddress(?ShippingAddress $shippingAddressRequest): self
    {
        $this->shippingAddress = $shippingAddressRequest;

        return $this;
    }

    public function setBillingAddress(?BillingAddress $billingAddressRequest): self
    {
        $this->billingAddress = $billingAddressRequest;

        return $this;
    }

    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $birthday = $this->birthday;
        $customerSince = $this->customer_since;

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
