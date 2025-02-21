<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Webhook;

use Lloricode\Paymaya\Request\Base;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 *
 * @method Webhook setId(string $id)
 * @method Webhook setName(string $name)
 * @method Webhook setCallbackUrl(string $callbackUrl)
 * @method Webhook setCreatedAt(string $createdAt)
 * @method Webhook setUpdatedAt(string $updatedAt)
 */
class Webhook extends Base
{
    public const CHECKOUT_SUCCESS = 'CHECKOUT_SUCCESS';

    public const CHECKOUT_FAILURE = 'CHECKOUT_FAILURE';

    public const CHECKOUT_DROPOUT = 'CHECKOUT_DROPOUT';

    public const PAYMENT_SUCCESS = 'PAYMENT_SUCCESS';

    public const PAYMENT_EXPIRED = 'PAYMENT_EXPIRED';

    public const PAYMENT_FAILED = 'PAYMENT_FAILED';

    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $callbackUrl = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}
}
