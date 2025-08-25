<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\PaymentDetailResponse;

readonly class PaymentDetail extends BaseResponse
{
    public function __construct(
        /** actual from paymaya is `3ds` */
        public bool $is3ds,
        public ?PaymentDetailResponse $responses = null,
        public ?string $paymentAt = null,
    ) {}
}
