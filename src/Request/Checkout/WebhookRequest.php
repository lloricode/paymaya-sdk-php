<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 */
class WebhookRequest extends BaseRequest
{
    public const SUCCESS = 'CHECKOUT_SUCCESS';
    public const FAILURE = 'CHECKOUT_FAILURE';
    public const DROPOUT = 'CHECKOUT_DROPOUT';

    private ?string $id = null;
    private string $name;
    private string $callback_url;

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

    public function getCallbackUrl(): string
    {
        return $this->callback_url;
    }

    public function setCallbackUrl(string $callbackUrl): self
    {
        $this->callback_url = $callbackUrl;

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
            'callbackUrl' => $this->callback_url,
        ];
    }
}
