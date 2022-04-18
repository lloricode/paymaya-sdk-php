<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Contact setPhone(string $string)
 * @method \Lloricode\Paymaya\Request\Checkout\Buyer\Contact setEmail(string $email)
 */
class Contact extends Base
{
    public ?string $phone = null;
    public ?string $email = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}
