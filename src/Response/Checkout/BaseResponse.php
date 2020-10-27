<?php

namespace Lloricode\Paymaya\Response\Checkout;

abstract class BaseResponse
{
    public static function new(): self
    {
        return new static();
    }
}
