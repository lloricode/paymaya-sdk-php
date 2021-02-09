<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\BaseRequest;

class ShippingAddressRequest extends BaseRequest
{
    public ?string $firstName = null;
    public ?string $middleName = null;
    public ?string $lastName = null;
    public ?string $phone = null;
    public ?string $email = null;
    public ?string $line1 = null;
    public ?string $line2 = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $zipCode = null;
    public ?string $countryCode = null;
    public ?string $shippingType = null; // ST - for standard, SD - for same day

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

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
        $this->zipCode = $zipCode;

        return $this;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function setShippingType(?string $shippingType): self
    {
        $this->shippingType = $shippingType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
            'line1' => $this->line1,
            'line2' => $this->line2,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'countryCode' => $this->countryCode,
            'shippingType' => $this->shippingType,
        ];
    }
}
