<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Concerns;

use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\Requests\Checkout\CreateCheckoutRequest;
use Lloricode\Paymaya\Requests\Checkout\GetCheckoutRequest;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;

/** @mixin \Lloricode\Paymaya\Paymaya */
trait CheckoutEndpoints
{
    public function getCheckout(string $id): CheckoutDto
    {
        return $this->send(new GetCheckoutRequest($id))->dtoOrFail();
    }

    public function createCheckout(CheckoutDto $checkoutDto): CheckoutResponse
    {
        return $this->send(new CreateCheckoutRequest($checkoutDto))->dtoOrFail();
    }
}
