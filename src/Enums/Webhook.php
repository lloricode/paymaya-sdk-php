<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Enums;

class Webhook
{
    public const string CHECKOUT_SUCCESS = 'CHECKOUT_SUCCESS';

    public const string CHECKOUT_FAILURE = 'CHECKOUT_FAILURE';

    public const string CHECKOUT_DROPOUT = 'CHECKOUT_DROPOUT';

    public const string PAYMENT_SUCCESS = 'PAYMENT_SUCCESS';

    public const string PAYMENT_EXPIRED = 'PAYMENT_EXPIRED';

    public const string PAYMENT_FAILED = 'PAYMENT_FAILED';
}
