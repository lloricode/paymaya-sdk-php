<?php

declare(strict_types=1);

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

    /** @inheritDoc */
    public function jsonSerialize(): array
    {
        return [
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}
