<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Item setName(string $name)
 * @method \Lloricode\Paymaya\Request\Checkout\Item setQuantity(int $quantity)
 * @method \Lloricode\Paymaya\Request\Checkout\Item setCode(string $code)
 * @method \Lloricode\Paymaya\Request\Checkout\Item setDescription(string $description)
 * @method \Lloricode\Paymaya\Request\Checkout\Item setAmount(Amount $amount)
 * @method \Lloricode\Paymaya\Request\Checkout\Item setTotalAmount(Amount $totalAmount)
 */
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
