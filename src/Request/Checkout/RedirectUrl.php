<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;

class RedirectUrl extends Base
{
    public ?string $success = null;
    public ?string $failure = null;
    public ?string $cancel = null;

    public function setSuccess(?string $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function setFailure(?string $failure): self
    {
        $this->failure = $failure;

        return $this;
    }

    public function setCancel(?string $cancel): self
    {
        $this->cancel = $cancel;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'success' => $this->success,
            'failure' => $this->failure,
            'cancel' => $this->cancel,
        ];
    }
}
