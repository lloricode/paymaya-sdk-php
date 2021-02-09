<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountRequest;

class ItemRequest extends BaseRequest
{
    public ?string $name = null;
    public int $quantity = 1;
    public ?string $code = null;
    public ?string $description = null;
    public AmountRequest $amount;
    public AmountRequest $totalAmount;

    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'amount', AmountRequest::class);
        self::setClassIfKeyNotExist($parameters, 'totalAmount', AmountRequest::class);
        self::toInt($parameters, 'quantity');

        parent::__construct($parameters);
    }

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

    public function setAmount(AmountRequest $amountRequest): self
    {
        $this->amount = $amountRequest;

        return $this;
    }

    public function setTotalAmount(AmountRequest $totalAmountRequest): self
    {
        $this->totalAmount = $totalAmountRequest;

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
            'amount' => $this->amount,
            'totalAmount' => $this->totalAmount,
        ];
    }
}
