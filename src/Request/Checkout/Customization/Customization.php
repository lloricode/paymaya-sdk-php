<?php

namespace Lloricode\Paymaya\Request\Checkout\Customization;

use Lloricode\Paymaya\Request\Base;

/**
 * https://hackmd.io/@paymaya-pg/Checkout#Customizations
 *
 * @method Customization setLogoUrl(string $logoUrl)
 * @method Customization setIconUrl(string $iconUrl)
 * @method Customization setAppleTouchIconUrl(string $appleTouchIconUrl)
 * @method Customization setCustomTitle(string $customTitle)
 * @method Customization setColorScheme(string $colorScheme)
 */
class Customization extends Base
{
    public ?string $logoUrl = '';
    public ?string $iconUrl = '';
    public ?string $appleTouchIconUrl = '';
    public ?string $customTitle = '';
    public ?string $colorScheme = '';

    public ?int $redirectTimer = null;
    public ?bool $hideReceiptInput = null;
    public ?bool $skipResultPage = null;
    public ?bool $showMerchantName = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
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
