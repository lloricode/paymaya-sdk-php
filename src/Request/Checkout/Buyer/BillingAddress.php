<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\Base;

/**
 * @method BillingAddress setLine1(string $line1)
 * @method BillingAddress setLine2(string $line2)
 * @method BillingAddress setCity(string $city)
 * @method BillingAddress setState(string $state)
 * @method BillingAddress setZipCode(string $zipCode)
 * @method BillingAddress setCountryCode(string $countryCode)
 */
class BillingAddress extends Base
{
    public ?string $line1 = null;
    public ?string $line2 = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $zipCode = null;
    public ?string $countryCode = null;

    /** @inheritDoc */
    public function jsonSerialize(): array
    {
        return [
            'line1' => $this->line1,
            'line2' => $this->line2,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'countryCode' => $this->countryCode,
        ];
    }
}
