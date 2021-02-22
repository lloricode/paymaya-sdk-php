<?php

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

class Receipt extends BaseResponse
{
    public string $transactionId;
    public string $receiptNo;
    public string $approval_code;
    public string $approvalCode;
}
