<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class RedirectUrlDto extends BaseDto
{
    public function __construct(
        public ?string $success = null,
        public ?string $failure = null,
        public ?string $cancel = null,
    ) {}
}
