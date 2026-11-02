<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Completed = 'completed';
    case Ongoing = 'ongoing';
    case Stalled = 'stalled';
    case Unspecified = 'unspecified';

    public function label(): string
    {
        return match ($this) {
            self::Completed => 'Completed',
            self::Ongoing => 'Ongoing',
            self::Stalled => 'Stalled',
            self::Unspecified => 'Not specified',
        };
    }
}
