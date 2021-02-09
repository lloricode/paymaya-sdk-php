<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;
use Lloricode\Paymaya\Response\Checkout\WebhookResponse;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 */
class WebhookRequest extends BaseRequest
{
    public const SUCCESS = 'CHECKOUT_SUCCESS';
    public const FAILURE = 'CHECKOUT_FAILURE';
    public const DROPOUT = 'CHECKOUT_DROPOUT';

    public ?string $id = null;
    public ?string $name = null;
    public ?string $callbackUrl = null;

    public function setResponse(WebhookResponse $webhookResponse): self
    {
        $this->id = $webhookResponse->getId();
        $this->name = $webhookResponse->getName();
        $this->callbackUrl = $webhookResponse->getCallbackUrl();

        return $this;
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
