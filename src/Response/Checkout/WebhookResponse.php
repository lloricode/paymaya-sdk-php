<?php

namespace Lloricode\Paymaya\Response\Checkout;

use JsonSerializable;

class WebhookResponse extends BaseResponse implements JsonSerializable
{
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
