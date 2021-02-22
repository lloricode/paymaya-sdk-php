<?php

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS;

use Carbon\Carbon;
use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount\Amount;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\Payer;

class EFS extends BaseResponse
{
    public string $paymentTransactionReferenceNo;
    public string $status;
    public Receipt $receipt;
    public Payer $payer;
    public Amount $amount;
    public Carbon $created_at;

    public function __construct(array $parameters = [])
    {
        self::setCarbon($parameters, 'created_at');
        parent::__construct($parameters);
    }
}
