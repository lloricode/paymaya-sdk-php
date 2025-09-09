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
    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function getCheckout(string $id): CheckoutDto
    {
        /** @var CheckoutDto $dto */
        $dto = $this->send(new GetCheckoutRequest($id))->dto();

        return $dto;
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function createCheckout(CheckoutDto $checkoutDto): CheckoutResponse
    {
        /** @var CheckoutResponse $dto */
        $dto = $this->send(new CreateCheckoutRequest($checkoutDto))->dto();

        return $dto;
    }
}
