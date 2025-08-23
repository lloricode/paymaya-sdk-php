<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

readonly class MetaDataDto extends BaseDto
{
    public function __construct(
        public ?string $smi = null,
        public ?string $smn = null,
        public ?string $mci = null,
        public ?string $mpc = null,
        public ?string $mco = null,
        public ?string $mst = null,
    ) {}

}
