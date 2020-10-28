<?php

namespace Lloricode\Paymaya\Response\Checkout;

class CheckoutResponse extends BaseResponse
{
    private string $id;
    private string $url;

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
