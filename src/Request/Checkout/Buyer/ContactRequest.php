<?php

namespace Lloricode\Paymaya\Request\Checkout\Buyer;

use Lloricode\Paymaya\Request\BaseRequest;

class ContactRequest extends BaseRequest
{
    private ?string $phone = null;
    private ?string $email = null;

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
