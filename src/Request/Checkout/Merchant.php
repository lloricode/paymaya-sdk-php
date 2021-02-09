<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;

class Merchant extends BaseRequest
{
    public string $currency = 'PHP';
    public string $email;
    public string $locale;
    public string $homepageUrl;

    public bool $isEmailToMerchantEnabled;
    public bool $isEmailToBuyerEnabled;
    public bool $isPaymentFacilitator;
    public bool $isPageCustomized;

    /**
     * @var string[]
     */
    public array $supportedSchemes;
    public bool $canPayPal;
    public ?string $payPalEmail = null;
    public ?string $payPalWebExperienceId = null;
    public bool $expressCheckout;
    public string $name;

    public function jsonSerialize()
    {
        return [

        ];
    }
}
