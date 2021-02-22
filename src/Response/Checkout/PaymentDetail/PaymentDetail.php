<?php

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail;

use Carbon\Carbon;
use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\PaymentDetailResponse;

class PaymentDetail extends BaseResponse
{
    public PaymentDetailResponse $responses;
    public Carbon $paymentAt;
    public bool $is3ds;

    public function __construct(array $parameters = [])
    {
        if (isset($parameters['3ds'])) {
            $parameters['is3ds'] = $parameters['3ds'];
            unset($parameters['3ds']);
        }

        self::setCarbon($parameters, 'paymentAt');

        parent::__construct($parameters);
    }
}
