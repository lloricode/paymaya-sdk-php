<?php

namespace Lloricode\Paymaya\Response\Checkout;

abstract class BaseResponse
{
    /**
     * @return static
     */
    public static function new(): self
    {
        return new static();
    }
}
