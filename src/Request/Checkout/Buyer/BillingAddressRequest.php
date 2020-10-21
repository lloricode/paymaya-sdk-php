<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\BaseRequest;

class BillingAddressRequest extends BaseRequest
{
    private ?string $line1 = null;
    private ?string $line2 = null;
    private ?string $city = null;
    private ?string $state = null;
    private ?string $zip_code = null;
    private ?string $country_code = null;

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

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'line1' => $this->line1,
            'line2' => $this->line2,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zip_code,
            'countryCode' => $this->country_code,
        ];
    }
}
