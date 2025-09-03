<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Refund\Refund200;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class RefundPayment200Receipt extends BaseResponse
{
    public function __construct(
        public string $transactionId,
        public int $approvalCode,
        public int $batchNo,
        public int $traceNo,
        public int $receiptNo,
    ) {}
}
