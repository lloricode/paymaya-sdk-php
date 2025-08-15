<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Enums;

enum Environment
{
    case production;
    case sandbox;
    case testing;

    public function url(): string
    {
        return match ($this) {
            self::production => 'https://pg.paymaya.com',
            self::sandbox => 'https://pg-sandbox.paymaya.com',
            self::testing => 'http://test.local',
        };
    }
}
