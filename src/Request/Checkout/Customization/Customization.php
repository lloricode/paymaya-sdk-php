<?php

declare(strict_types=1);

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
    public function __construct(
        public ?string $logoUrl = '',
        public ?string $iconUrl = '',
        public ?string $appleTouchIconUrl = '',
        public ?string $customTitle = '',
        public ?string $colorScheme = '',
        public ?int $redirectTimer = null,
        public ?bool $hideReceiptInput = null,
        public ?bool $skipResultPage = null,
        public ?bool $showMerchantName = null,
    ) {}
}
