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
    public function __construct(
        public ?string $line1 = null,
        public ?string $line2 = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $zipCode = null,
        public ?string $countryCode = null
    ) {
    }
}
