<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\BaseRequest;

class BuyerRequest extends BaseRequest
{
    private ?string $first_name = null;
    private ?string $middle_name = null;
    private ?string $last_name = null;

    private ?Carbon $birth_date = null;
    private ?Carbon $customer_since = null;
    private ?string $gender = null;

    private ContactRequest $contact_request;
    private ShippingAddressRequest $shipping_address_request;
    private BillingAddressRequest $billing_address_request;

    public function setFirstName(?string $firstName): self
    {
        $this->first_name = $firstName;

        return $this;
    }

    public function setMiddleName(?string $firstMiddleName): self
    {
        $this->middle_name = $firstMiddleName;

        return $this;
    }

    public function setLastName(?string $lastName): self
    {
        $this->last_name = $lastName;

        return $this;
    }

    public function setBirthDate(?Carbon $birthDate): self
    {
        $this->birth_date = $birthDate;

        return $this;
    }

    public function setCustomerSince(?Carbon $customersince): self
    {
        $this->customer_since = $customersince;

        return $this;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function setContactRequest(ContactRequest $contactRequest): self
    {
        $this->contact_request = $contactRequest;

        return $this;
    }

    public function setShippingAddressRequest(ShippingAddressRequest $shippingAddressRequest): self
    {
        $this->shipping_address_request = $shippingAddressRequest;

        return $this;
    }

    public function setBillingAddressRequest(BillingAddressRequest $billingAddressRequest): self
    {
        $this->billing_address_request = $billingAddressRequest;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        $birthDate = $this->birth_date;
        $customerSince = $this->customer_since;

        if (! is_null($birthDate)) {
            $birthDate = $birthDate->format('Y-m-d');
        }

        if (! is_null($customerSince)) {
            $customerSince = $customerSince->format('Y-m-d');
        }

        return [
            'firstName' => $this->first_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->last_name,
            'birthday' => $birthDate,
            'customerSince' => $customerSince,
            'sex' => $this->gender,
            'contact' => $this->contact_request->jsonSerialize(),
            'shippingAddress' => $this->shipping_address_request->jsonSerialize(),
            'billingAddress' => $this->billing_address_request->jsonSerialize(),
        ];
    }
}
