<?php

namespace Lloricode\Paymaya\Request;

use JsonSerializable;

abstract class BaseRequest implements JsonSerializable
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
