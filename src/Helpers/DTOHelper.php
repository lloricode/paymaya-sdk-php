<?php

namespace Lloricode\Paymaya\Helpers;

use Carbon\Carbon;

trait DTOHelper
{
    public static function setCarbon(array &$array, string $key): void
    {
        if (! isset($array[$key]) || $array[$key] instanceof Carbon) {
            return;
        }

        $array[$key] = Carbon::parse($array[$key]);
    }

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
     * @param  object|string  $class
     */
    protected static function setClassIfKeyNotExist(array &$array, string $key, object|string $class): void
    {
        if (isset($array[$key])) {
            return;
        }

        $array[$key] = is_string($class) ? new $class() : $class;
    }
}
