<?php

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

class Total extends BaseResponse
{
    public string $currency;
    public float $value;
}
