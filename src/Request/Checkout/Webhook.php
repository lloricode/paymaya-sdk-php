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
    public const SUCCESS = 'CHECKOUT_SUCCESS';
    public const FAILURE = 'CHECKOUT_FAILURE';
    public const DROPOUT = 'CHECKOUT_DROPOUT';

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
