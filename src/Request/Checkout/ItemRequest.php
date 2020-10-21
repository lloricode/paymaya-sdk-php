<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountRequest;

class ItemRequest extends BaseRequest
{
    private ?string $name = null;
    private int $quantity = 1;
    private ?string $code = null;
    private ?string $description = null;
    private AmountRequest $amount_request;
    private AmountRequest $total_amount_request;

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setAmountRequest(AmountRequest $amountRequest): self
    {
        $this->amount_request = $amountRequest;

        return $this;
    }

    public function setTotalAmountRequest(AmountRequest $totalAmountRequest): self
    {
        $this->total_amount_request = $totalAmountRequest;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'quantity' => $this->quantity,
            'code' => $this->code,
            'description' => $this->description,
            'amount' => $this->amount_request,
            'totalAmount' => $this->total_amount_request,
        ];
    }
}
