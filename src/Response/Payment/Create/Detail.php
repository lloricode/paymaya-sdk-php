<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Create;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class Detail extends BaseResponse
{
    public function __construct(
        public string $scheme,
        public string $last4,
        public string $first6,
        public string $masked,
        public string $issuer,
    ) {}
}
