<?php

namespace Lloricode\Paymaya\Request\Checkout\Customization;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Customization\Customization setLogoUrl(string $logoUrl)
 * @method \Lloricode\Paymaya\Request\Checkout\Customization\Customization setIconUrl(string $iconUrl)
 * @method \Lloricode\Paymaya\Request\Checkout\Customization\Customization setAppleTouchIconUrl(string $appleTouchIconUrl)
 * @method \Lloricode\Paymaya\Request\Checkout\Customization\Customization setCustomTitle(string $customTitle)
 * @method \Lloricode\Paymaya\Request\Checkout\Customization\Customization setColorScheme(string $colorScheme)
 */
class Customization extends Base
{
    public ?string $logoUrl = '';
    public ?string $iconUrl = '';
    public ?string $appleTouchIconUrl = '';
    public ?string $customTitle = '';
    public ?string $colorScheme = '';

    public int $redirectTimer = 1;
    public bool $hideReceiptInput = true;
    public bool $skipResultPage = true;
    public bool $showMerchantName = true;

    public function jsonSerialize()
    {
        return [
            'logoUrl' => $this->logoUrl,
            'iconUrl' => $this->iconUrl,
            'appleTouchIconUrl' => $this->appleTouchIconUrl,
            'customTitle' => $this->customTitle,
            'colorScheme' => $this->colorScheme,

            'redirectTimer' => $this->redirectTimer,
            'hideReceiptInput' => $this->hideReceiptInput,
            'skipResultPage' => $this->skipResultPage,
            'showMerchantName' => $this->showMerchantName,
        ];
    }
}
