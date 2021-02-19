<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\Base;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 */
class Webhook extends Base
{
    public const SUCCESS = 'CHECKOUT_SUCCESS';
    public const FAILURE = 'CHECKOUT_FAILURE';
    public const DROPOUT = 'CHECKOUT_DROPOUT';

    public ?string $id = null;
    public ?string $name = null;
    public ?string $callbackUrl = null;
    public ?Carbon $created_at = null;
    public ?Carbon $updated_at = null;

//    public function setResponse(Webhook $webhookResponse): self
//    {
//        return $webhookResponse;
////        $this->id = $webhookResponse->getId();
////        $this->name = $webhookResponse->getName();
////        $this->callbackUrl = $webhookResponse->getCallbackUrl();
////
////        return $this;
//    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(string $callbackUrl): self
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    public function setCreatedAt(Carbon $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function setUpdatedAt(Carbon $updatedAt): self
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
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
