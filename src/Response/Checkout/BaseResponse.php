<?php

namespace Lloricode\Paymaya\Response\Checkout;

use Lloricode\Paymaya\DTOCaster;
use Lloricode\Paymaya\Helpers\DTOHelper;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

#[CastWith(DTOCaster::class)]
abstract class BaseResponse extends DataTransferObject
{
    use DTOHelper;
}
