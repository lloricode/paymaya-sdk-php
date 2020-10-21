<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;

class RedirectUrlRequest extends BaseRequest
{
    private ?string $success = null;
    private ?string $failure = null;
    private ?string $cancel = null;

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
