<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

readonly class Receipt extends BaseResponse
{
    public function __construct(
        public string $transactionId,
        public string $receiptNo,
        public string $approval_code,
        public string $approvalCode,
    ) {}
}
