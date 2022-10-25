<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\Base;

/**
 * @method ShippingAddress setFirstName(string $firstName)
 * @method ShippingAddress setMiddleName(string $middleName)
 * @method ShippingAddress setLastName(string $lastName)
 * @method ShippingAddress setPhone(string $phone)
 * @method ShippingAddress setEmail(string $email)
 * @method ShippingAddress setLine1(string $line1)
 * @method ShippingAddress setLine2(string $line2)
 * @method ShippingAddress setCity(string $city)
 * @method ShippingAddress setState(string $state)
 * @method ShippingAddress setZipCode(string $zipCode)
 * @method ShippingAddress setCountryCode(string $countryCode)
 * @method ShippingAddress setShippingType(string $shippingType)
 */
class ShippingAddress extends Base
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

    /** @inheritDoc */
    public function jsonSerialize(): array
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
