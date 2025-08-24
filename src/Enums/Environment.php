<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Enums;

enum Environment: string
{
    case production = 'production';
    case sandbox = 'sandbox';
    case testing = 'testing';

    public function url(): string
    {
        return match ($this) {
            self::production => 'https://pg.paymaya.com',
            self::sandbox => 'https://pg-sandbox.paymaya.com',
            self::testing => 'http://test.local',
        };
    }
}
