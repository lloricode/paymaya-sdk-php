<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout\Customization;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class CustomizationDto extends BaseDto
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
