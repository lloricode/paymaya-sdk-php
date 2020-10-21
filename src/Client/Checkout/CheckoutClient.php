<?php

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Client\UriVersion;

class CheckoutClient extends BaseClient
{
    /**
     * @inheritDoc
     */
    protected function uris(): array
    {
        return [
            new UriVersion('/checkout/v1/checkouts'),
        ];
    }
}
