<?php

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS;

use Carbon\Carbon;
use Lloricode\Paymaya\Casters\CarbonCaster;
use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount\Amount;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\Payer;
use Spatie\DataTransferObject\Attributes\CastWith;

class EFS extends BaseResponse
{
    public string $paymentTransactionReferenceNo;
    public string $status;
    public Receipt $receipt;
    public Payer $payer;
    public Amount $amount;
    #[CastWith(CarbonCaster::class)]
    public Carbon $created_at;
}
