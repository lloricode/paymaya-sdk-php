<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Checkout;

class CheckoutResponse extends BaseResponse
{
    public function __construct(
        public string $checkoutId,
        public string $redirectUrl,
    ) {
    }

    public function setCheckoutId(string $checkoutId): self
    {
        $this->checkoutId = $checkoutId;

        return $this;
    }

    public function setRedirectUrl(string $redirectUrl): self
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }
}
