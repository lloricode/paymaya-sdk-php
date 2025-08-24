<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Customization;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class CustomizationDto extends BaseDto
{
    public function __construct(
        public string $logoUrl,
        public string $iconUrl,
        public string $appleTouchIconUrl,
        public string $customTitle,
        public string $colorScheme,
        public bool $hideReceiptInput = false,
        public bool $skipResultPage = false,
        public bool $showMerchantName = true,
        public int $redirectTimer = 30,
    ) {}
}
