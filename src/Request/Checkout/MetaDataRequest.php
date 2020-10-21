<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;

class MetaDataRequest extends BaseRequest
{

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [];
    }
}
