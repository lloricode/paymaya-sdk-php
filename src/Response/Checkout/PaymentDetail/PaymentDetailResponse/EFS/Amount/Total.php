<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

class Total extends BaseResponse
{
    public function __construct(
        public string $currency,
        public float $value,
    ) {}
}
