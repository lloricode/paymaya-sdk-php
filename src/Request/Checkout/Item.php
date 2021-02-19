<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;

class Item extends Base
{
    public ?string $name = null;
    public int $quantity = 1;
    public ?string $code = null;
    public ?string $description = null;
    public Amount $amount;
    public Amount $totalAmount;

    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'amount', Amount::class);
        self::setClassIfKeyNotExist($parameters, 'totalAmount', Amount::class);
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

    public function setAmount(Amount $amountRequest): self
    {
        $this->amount = $amountRequest;

        return $this;
    }

    public function setTotalAmount(Amount $totalAmountRequest): self
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
