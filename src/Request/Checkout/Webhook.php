<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\Base;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 *
 * @method \Lloricode\Paymaya\Request\Checkout\Webhook setId(string $id)
 * @method \Lloricode\Paymaya\Request\Checkout\Webhook setName(string $name)
 * @method \Lloricode\Paymaya\Request\Checkout\Webhook setCallbackUrl(string $callbackUrl)
 * @method \Lloricode\Paymaya\Request\Checkout\Webhook setCreatedAt(Carbon $createdAt)
 * @method \Lloricode\Paymaya\Request\Checkout\Webhook setUpdatedAt(Carbon $updatedAt)
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
    public ?Carbon $createdAt = null;
    public ?Carbon $updatedAt = null;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'callbackUrl' => $this->callbackUrl,
        ];
    }

    public function fromArray(array $array): self
    {
        $this->setId($array['id'])
            ->setName($array['name'])
            ->setCallbackUrl($array['callbackUrl'])
            ->setCreatedAt(Carbon::parse($array['createdAt']))
            ->setUpdatedAt(Carbon::parse($array['updatedAt']));

        return $this;
    }
}
