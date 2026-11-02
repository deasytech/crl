<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class Media
{
    /** Public URL for a file stored on the `public` disk, or null when no path is set. */
    public static function url(?string $path): ?string
    {
        return filled($path) ? Storage::disk('public')->url($path) : null;
    }
}
