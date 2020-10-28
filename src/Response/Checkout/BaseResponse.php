<?php

namespace Lloricode\Paymaya\Response\Checkout;

abstract class BaseResponse
{
    final public function __construct()
    {
    }
    /**
     * @return static
     */
    public static function new(): self
    {
        return new static();
    }
}
