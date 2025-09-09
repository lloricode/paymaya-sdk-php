<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use Lloricode\Paymaya\Concerns\CheckoutEndpoints;
use Lloricode\Paymaya\Concerns\CustomizationEndpoints;
use Lloricode\Paymaya\Concerns\PaymentEndpoints;
use Lloricode\Paymaya\Concerns\WebhookEndpoints;

class Paymaya extends PaymayaConnector
{
    use CheckoutEndpoints;
    use CustomizationEndpoints;
    use PaymentEndpoints;
    use WebhookEndpoints;
}
