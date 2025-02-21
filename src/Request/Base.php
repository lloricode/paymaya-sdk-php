<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request;

use ErrorException;
use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

abstract class Base // implements JsonSerializable
{
    public function __call(string $name, mixed $arguments): static
    {
        $propertyNames = [];

        foreach (
            (new ReflectionClass(static::class))
                ->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty
        ) {
            if ($reflectionProperty->isStatic()) {
                continue;
            }

            $field = $reflectionProperty->getName();

            $propertyNames['set'.ucfirst($field)] = $field;
        }

        if (! array_key_exists($name, $propertyNames)) {
            throw new ErrorException(sprintf('%s::%s() not found.', static::class, $name));
        }

        if (count($arguments) !== 1) {
            throw new ErrorException(sprintf('Argument of %s::%s() is 1 expected.', static::class, $name));
        }

        $this->{$propertyNames[$name]} = $arguments[0];

        return $this;
    }

    public function toArray(): array
    {
        /** @phpstan-ignore-next-line  */
        return json_decode(json_encode($this), true);
    }
}
