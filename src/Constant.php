<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use Lloricode\Paymaya\Enums\Environment;

final class Constant
{
    public static Environment $environment;

    public static string $secretKey;

    public static string $publicKey;

    private function __construct() {}
}
