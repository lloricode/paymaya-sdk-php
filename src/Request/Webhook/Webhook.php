<?php

namespace Lloricode\Paymaya\Request\Webhook;

use Carbon\Carbon;
use Lloricode\Paymaya\Casters\CarbonCaster;
use Lloricode\Paymaya\Request\Base;
use Spatie\DataTransferObject\Attributes\CastWith;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 *
 * @method Webhook setId(string $id)
 * @method Webhook setName(string $name)
 * @method Webhook setCallbackUrl(string $callbackUrl)
 * @method Webhook setCreatedAt(Carbon $createdAt)
 * @method Webhook setUpdatedAt(Carbon $updatedAt)
 */
class Webhook extends Base
{
    public const CHECKOUT_SUCCESS = 'CHECKOUT_SUCCESS';
    public const CHECKOUT_FAILURE = 'CHECKOUT_FAILURE';
    public const CHECKOUT_DROPOUT = 'CHECKOUT_DROPOUT';

    public const PAYMENT_SUCCESS = 'PAYMENT_SUCCESS';
    public const PAYMENT_EXPIRED = 'PAYMENT_EXPIRED';
    public const PAYMENT_FAILED = 'PAYMENT_FAILED';

    public ?string $id = null;
    public ?string $name = null;
    public ?string $callbackUrl = null;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $createdAt = null;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $updatedAt = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'callbackUrl' => $this->callbackUrl,
        ];
    }
}
