<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects;

use JsonSerializable;

abstract readonly class BaseDto // implements JsonSerializable
{
    public function toArray(): array
    {
        /** @phpstan-ignore-next-line  */
        return json_decode(json_encode($this), true);
    }
}
