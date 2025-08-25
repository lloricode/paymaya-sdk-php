<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Enums;

enum Environment: string
{
    case Production = 'Production';
    case Sandbox = 'Sandbox';
    case Testing = 'Testing';

    public function url(): string
    {
        return match ($this) {
            self::Production => 'https://pg.paymaya.com',
            self::Sandbox => 'https://pg-sandbox.paymaya.com',
            self::Testing => 'http://test.local',
        };
    }
}
