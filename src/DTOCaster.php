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
        private string $className
    ) {
    }

    public function cast(mixed $value): DataTransferObject
    {
        if ($value instanceof $this->className) {
            return $value;
        }

        return new $this->className($value);
    }
}
