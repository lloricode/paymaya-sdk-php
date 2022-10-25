<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail;

use Carbon\Carbon;
use Lloricode\Paymaya\Casters\CarbonCaster;
use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\PaymentDetailResponse;
use Spatie\DataTransferObject\Attributes\CastWith;

class PaymentDetail extends BaseResponse
{
    public PaymentDetailResponse $responses;
    #[CastWith(CarbonCaster::class)]
    public Carbon $paymentAt;
    public bool $is3ds;

    public function __construct(array $parameters = [])
    {
        if (isset($parameters['3ds'])) {
            $parameters['is3ds'] = $parameters['3ds'];
            unset($parameters['3ds']);
        }

        parent::__construct($parameters);
    }
}
