<?php

namespace Lloricode\Paymaya\Request;

use JsonSerializable;

abstract class BaseRequest implements JsonSerializable
{
    /**
     * @return static
     */
    public static function new(): self
    {
        return new static();
    }
}
