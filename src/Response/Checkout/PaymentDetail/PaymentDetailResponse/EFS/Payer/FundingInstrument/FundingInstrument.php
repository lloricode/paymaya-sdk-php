<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\FundingInstrument;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

readonly class FundingInstrument extends BaseResponse
{
    public function __construct(
        public Card $card
    ) {}
}
