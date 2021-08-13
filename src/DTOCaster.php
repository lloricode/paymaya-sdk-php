<?php

namespace Lloricode\Paymaya;

use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * https://github.com/spatie/data-transfer-object/pull/208
 */
class DTOCaster implements Caster
{
    public function __construct(
        private array $classNames
    ) {
    }

    public function cast(mixed $value): DataTransferObject
    {
        foreach ($this->classNames as $className) {
            if ($value instanceof $className) {
                return $value;
            }
        }

        return new $this->classNames[0]($value);
    }
}
