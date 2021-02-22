<?php

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\EFS;

class PaymentDetailResponse extends BaseResponse
{
    public EFS $efs;
}
