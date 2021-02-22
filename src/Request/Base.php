<?php

namespace Lloricode\Paymaya\Request;

use Carbon\Carbon;
use ErrorException;
use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;
use Spatie\DataTransferObject\DataTransferObject;

abstract class Base extends DataTransferObject implements JsonSerializable
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
     * @param  string|object  $class
     */
    protected static function setClassIfKeyNotExist(array &$array, string $key, $class): void
    {
        if (isset($array[$key])) {
            return;
        }

        $array[$key] = is_string($class) ? new $class() : $class;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return $this
     * @throws \ErrorException
     */
    public function __call($name, $arguments): self
    {
        $properties = [];

        foreach (
            (new ReflectionClass(static::class))
                ->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty
        ) {
            if ($reflectionProperty->isStatic()) {
                continue;
            }

            $field = $reflectionProperty->getName();

            $properties['set'.ucfirst($field)] = $field;
        }

        if (! array_key_exists($name, $properties)) {
            throw new ErrorException(sprintf('%s::%s() not found.', static::class, $name));
        }

        if (count($arguments) !== 1) {
            throw new ErrorException(sprintf('Argument of %s::%s is 1 expected.', static::class, $name));
        }

        $this->{$properties[$name]} = $arguments[0];

        return $this;
    }
}
