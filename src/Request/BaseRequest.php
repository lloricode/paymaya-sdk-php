<?php

namespace Lloricode\Paymaya\Request;

use JsonSerializable;

abstract class BaseRequest implements JsonSerializable
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
