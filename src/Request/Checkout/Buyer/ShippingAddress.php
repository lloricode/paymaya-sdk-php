<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setFirstName(string $firstName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setMiddleName(string $middleName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setLastName(string $lastName)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setPhone(string $phone)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setEmail(string $email)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setLine1(string $line1)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setLine2(string $line2)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setCity(string $city)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setState(string $state)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setZipCode(string $zipCode)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setCountryCode(string $countryCode)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress setShippingType(string $shippingType)
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
