<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\BaseRequest;

class ShippingAddressRequest extends BaseRequest
{
    private ?string $first_name = null;
    private ?string $middle_name = null;
    private ?string $last_name = null;
    private ?string $phone = null;
    private ?string $email = null;
    private ?string $line1 = null;
    private ?string $line2 = null;
    private ?string $city = null;
    private ?string $state = null;
    private ?string $zip_code = null;
    private ?string $country_code = null;
    private ?string $shipping_type = null; // ST - for standard, SD - for same day

    public function setFirstName(?string $firstName): self
    {
        $this->first_name = $firstName;

        return $this;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middle_name = $middleName;

        return $this;
    }

    public function setLastName(?string $lastName): self
    {
        $this->last_name = $lastName;

        return $this;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setLine1(?string $line1): self
    {
        $this->line1 = $line1;

        return $this;
    }

    public function setLine2(?string $line2): self
    {
        $this->line2 = $line2;

        return $this;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zip_code = $zipCode;

        return $this;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->country_code = $countryCode;

        return $this;
    }

    public function setShippingType(?string $shippingType): self
    {
        $this->shipping_type = $shippingType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'firstName' => $this->first_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'line1' => $this->line1,
            'line2' => $this->line2,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zip_code,
            'countryCode' => $this->country_code,
            'shippingType' => $this->shipping_type,
        ];
    }
}
