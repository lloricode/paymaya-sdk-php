<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\Base;

/**
 * @method \Lloricode\Paymaya\Request\Checkout\RedirectUrl setSuccess(string $success)
 * @method \Lloricode\Paymaya\Request\Checkout\RedirectUrl setFailure(string $failure)
 * @method \Lloricode\Paymaya\Request\Checkout\RedirectUrl setCancel(string $cancel)
 */
class RedirectUrl extends Base
{
    public function __construct(
        public ?string $success = null,
        public ?string $failure = null,
        public ?string $cancel = null,
    ) {
    }
}
