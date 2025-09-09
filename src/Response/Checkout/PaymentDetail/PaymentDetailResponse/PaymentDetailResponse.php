<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse;

use Lloricode\Paymaya\Response\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\EFS;

readonly class PaymentDetailResponse extends BaseResponse
{
    public function __construct(public EFS $efs) {}
}
