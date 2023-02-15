<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
abstract class BaseDTO extends DataTransferObject
{
    protected static function setClassIfKeyNotExist(array &$array, string $key, object|string $class): void
    {
        if (isset($array[$key])) {
            return;
        }

        $array[$key] = is_string($class) ? new $class() : $class;
    }
}
