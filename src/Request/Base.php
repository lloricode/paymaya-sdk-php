<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request;

use ErrorException;
use JsonSerializable;
use Lloricode\Paymaya\BaseDTO;
use ReflectionClass;
use ReflectionProperty;

abstract class Base extends BaseDTO implements JsonSerializable
{
    /** @throws ErrorException */
    public function __call(string $name, mixed $arguments): static
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

        if ( ! array_key_exists($name, $properties)) {
            throw new ErrorException(sprintf('%s::%s() not found.', static::class, $name));
        }

        if (count($arguments) !== 1) {
            throw new ErrorException(sprintf('Argument of %s::%s() is 1 expected.', static::class, $name));
        }

        $this->{$properties[$name]} = $arguments[0];

        return $this;
    }
}
