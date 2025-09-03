<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class Amount extends BaseResponse
{
    public function __construct(public Total $total) {}
}
