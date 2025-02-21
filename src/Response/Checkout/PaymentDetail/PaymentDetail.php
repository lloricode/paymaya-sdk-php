<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\PaymentDetailResponse;

class PaymentDetail extends BaseResponse
{
    public function __construct(
        public PaymentDetailResponse $responses,
        public string $paymentAt,
        /** actual from paymaya is `3ds` */
        public bool $is3ds,
    ) {
        //        if (isset($parameters['3ds'])) {
        //            $parameters['is3ds'] = $parameters['3ds'];
        //            unset($parameters['3ds']);
        //        }
    }
}
