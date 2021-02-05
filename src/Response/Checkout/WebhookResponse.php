<?php

namespace Lloricode\Paymaya\Response\Checkout;

use Carbon\Carbon;
use JsonSerializable;

class WebhookResponse extends BaseResponse implements JsonSerializable
{
    private ?string $id = null;
    private string $name;
    private string $callback_url;
    private Carbon $created_at;
    private Carbon $updated_at;

    public function getName(): string
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

    public function getCallbackUrl(): string
    {
        return $this->callback_url;
    }

    public function setCallbackUrl(string $callbackUrl): self
    {
        $this->callback_url = $callbackUrl;

        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function setCreatedAt(Carbon $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(Carbon $updatedAt): self
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'callbackUrl' => $this->callback_url,
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
