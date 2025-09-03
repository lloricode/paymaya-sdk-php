<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class CheckoutResponse extends BaseResponse
{
    public function __construct(
        public string $checkoutId,
        public string $redirectUrl,
    ) {}

}
