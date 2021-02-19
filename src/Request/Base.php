<?php

namespace Lloricode\Paymaya\Request;

use Carbon\Carbon;
use JsonSerializable;
use Spatie\DataTransferObject\DataTransferObject;

abstract class Base extends DataTransferObject implements JsonSerializable
{
    protected static function toFloat(array &$array, string $key): void
    {
        $array[$key] = (float)($array[$key] ?? 0);
    }

    protected static function toInt(array &$array, string $key): void
    {
        $array[$key] = (int)($array[$key] ?? 0);
    }

    /**
     * @param  array  $array
     * @param  string  $key
     * @param  string|object  $class
     */
    protected static function setClassIfKeyNotExist(array &$array, string $key, $class): void
    {
        if (isset($array[$key])) {
            return;
        }

        $array[$key] = is_string($class) ? new $class() : $class;
    }

    public static function setCarbon(array &$array, string $key): void
    {
        if (! isset($array[$key]) || $array[$key] instanceof Carbon) {
            return;
        }

        $array[$key] = Carbon::parse($array[$key]);
    }
}
