<?php

namespace Lloricode\Paymaya\Response\Checkout;

use Lloricode\Paymaya\Helpers\DTOHelper;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseResponse extends DataTransferObject
{
    use DTOHelper;
}
