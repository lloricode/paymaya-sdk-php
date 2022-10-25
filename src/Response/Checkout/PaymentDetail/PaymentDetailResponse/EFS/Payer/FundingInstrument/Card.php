<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\FundingInstrument;

use Lloricode\Paymaya\Response\Checkout\BaseResponse;

class Card extends BaseResponse
{
    public string $cardNumber;
    public string $expiryMonth;
    public string $expiryYear;
}
