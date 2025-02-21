<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;

class Merchant extends Base
{
    public function __construct(
        public string $email,
        public string $locale,
        public string $homepageUrl,
        public bool $isEmailToMerchantEnabled,
        public bool $isEmailToBuyerEnabled,
        public bool $isPaymentFacilitator,
        public bool $isPageCustomized,

        /** @var string[] */
        public array $supportedSchemes,
        public bool $canPayPal,
        public bool $expressCheckout,
        public string $name,
        public ?string $payPalEmail = null,
        public ?string $payPalWebExperienceId = null,
        public string $currency = 'PHP',
    ) {}
}
