<?php

namespace App\Models;

use App\Models\Concerns\HasOptimisedImages;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

/**
 * @property list<array{title: string, body: string}>|null $highlights
 * @property list<array{title: string, body: string}>|null $approach_steps
 * @property list<array{title: string, body: string}>|null $why_points
 */
#[Fillable([
    'hero_headline', 'hero_subheading', 'hero_image', 'hero_image_alt',
    'primary_cta_label', 'primary_cta_url', 'secondary_cta_label', 'secondary_cta_url',
    'intro_heading', 'intro_body', 'intro_image', 'intro_image_alt',
    'closing_heading', 'closing_body', 'closing_cta_label', 'closing_cta_url',
    'highlights', 'approach_steps', 'why_points',
])]
final class HomepageSetting extends Model implements HasMedia
{
    use HasOptimisedImages;

    protected function casts(): array
    {
        return ['highlights' => 'array', 'approach_steps' => 'array', 'why_points' => 'array'];
    }

    /** The single settings row, or an unsaved default if none exists. */
    public static function current(): static
    {
        return self::query()->first() ?? new self(['hero_headline' => config('app.name')]);
    }

    /** @return array<string, string> */
    protected function imageColumns(): array
    {
        return [
            'hero_image' => 'hero',
            'intro_image' => 'intro',
        ];
    }
}
