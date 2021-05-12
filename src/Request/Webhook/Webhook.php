<?php

namespace Lloricode\Paymaya\Request\Webhook;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\Base;

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
    public ?Carbon $createdAt = null;
    public ?Carbon $updatedAt = null;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(array $parameters = [])
    {
        self::setCarbon($parameters, 'createdAt');
        self::setCarbon($parameters, 'updatedAt');

        parent::__construct($parameters);
    }

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
}
