<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\Base;

class Contact extends Base
{
    public ?string $phone = null;
    public ?string $email = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
