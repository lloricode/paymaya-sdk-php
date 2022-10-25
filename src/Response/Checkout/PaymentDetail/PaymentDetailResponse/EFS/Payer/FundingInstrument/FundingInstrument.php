<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\FundingInstrument;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

class FundingInstrument extends BaseResponse
{
    public Card $card;
}
