<?php

namespace App\Enums;

enum TeamGroup: string
{
    case Core = 'core';
    case Affiliate = 'affiliate';

    public function label(): string
    {
        return match ($this) {
            self::Core => 'Core team',
            self::Affiliate => 'Affiliate consultant',
        };
    }
}
