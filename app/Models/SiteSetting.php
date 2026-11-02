<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'company_name', 'registration_number', 'tagline', 'footer_text', 'address', 'office_phone',
    'mobile_phone', 'primary_email', 'enquiry_recipient', 'website_url', 'social_links',
    'vision', 'mission', 'founded_year', 'seo_title', 'seo_description', 'og_image',
])]
final class SiteSetting extends Model
{
    protected function casts(): array
    {
        return ['social_links' => 'array'];
    }

    /** The single settings row, created empty if it does not exist yet. */
    public static function current(): static
    {
        return self::query()->first() ?? new self(['company_name' => config('app.name')]);
    }
}
