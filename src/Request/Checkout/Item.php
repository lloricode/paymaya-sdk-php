<?php

declare(strict_types=1);

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

    /** @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties */
    public function __construct(...$args)
    {
        self::setClassIfKeyNotExist($args, 'amount', Amount::class);
        self::setClassIfKeyNotExist($args, 'totalAmount', Amount::class);

        parent::__construct(...$args);
    }

    /** @inheritDoc */
    public function jsonSerialize(): array
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
