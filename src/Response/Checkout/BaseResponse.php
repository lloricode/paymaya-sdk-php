<?php

namespace Lloricode\Paymaya\Response\Checkout;

abstract class BaseResponse
{
    public function __construct()
    {
    }

    /**
     * @return static
     * @deprecated please use constructor, this will remove in stable release
     */
    public static function new(): self
    {
        return new static();
    }
}
