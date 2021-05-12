<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;

/**
 * @method Item setName(string $name)
 * @method Item setQuantity(int $quantity)
 * @method Item setCode(string $code)
 * @method Item setDescription(string $description)
 * @method Item setAmount(Amount $amount)
 * @method Item setTotalAmount(Amount $totalAmount)
 */
class Item extends Base
{
    public ?string $name = null;
    public int $quantity = 1;
    public ?string $code = null;
    public ?string $description = null;
    public Amount $amount;
    public Amount $totalAmount;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
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
