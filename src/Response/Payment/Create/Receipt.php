<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Create;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class Receipt extends BaseResponse
{
    public function __construct(
        public string $transactionId,
        public string $approvalCode,
        public string $receiptNo,
        public string $approval_code,
    ) {}
}
