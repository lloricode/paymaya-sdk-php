<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Customization;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * https://hackmd.io/@paymaya-pg/Checkout#Customizations
 *
 * @method self setLogoUrl(string $logoUrl)
 * @method self setIconUrl(string $iconUrl)
 * @method self setAppleTouchIconUrl(string $appleTouchIconUrl)
 * @method self setCustomTitle(string $customTitle)
 * @method self setColorScheme(string $colorScheme)
 */
class CustomizationDto extends BaseDto
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
