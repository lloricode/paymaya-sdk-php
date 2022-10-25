<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\RedirectUrl setSuccess(string $success)
 * @method \Lloricode\Paymaya\Request\Checkout\RedirectUrl setFailure(string $failure)
 * @method \Lloricode\Paymaya\Request\Checkout\RedirectUrl setCancel(string $cancel)
 */
class RedirectUrl extends Base
{
    public ?string $success = null;
    public ?string $failure = null;
    public ?string $cancel = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'success' => $this->success,
            'failure' => $this->failure,
            'cancel' => $this->cancel,
        ];
    }
}
