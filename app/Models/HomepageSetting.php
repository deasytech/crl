<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'hero_headline', 'hero_subheading', 'hero_image', 'hero_image_alt',
    'primary_cta_label', 'primary_cta_url', 'secondary_cta_label', 'secondary_cta_url',
    'intro_heading', 'intro_body', 'intro_image', 'intro_image_alt',
    'closing_heading', 'closing_body', 'closing_cta_label', 'closing_cta_url',
])]
final class HomepageSetting extends Model
{
    /** The single settings row, or an unsaved default if none exists. */
    public static function current(): static
    {
        return self::query()->first() ?? new self(['hero_headline' => config('app.name')]);
    }
}
