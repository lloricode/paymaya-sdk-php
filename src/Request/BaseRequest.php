<?php

namespace Lloricode\Paymaya\Request;

use JsonSerializable;

abstract class BaseRequest implements JsonSerializable
{
    public static function new()
    {
        return new static();
    }
}
