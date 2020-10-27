<?php

namespace Lloricode\Paymaya\Response\Checkout;

class CheckoutResponse extends BaseResponse
{
    private string $id;
    private string $url;

    public function __construct(string $id, string $url)
    {
        $this->id = $id;
        $this->url = $url;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
