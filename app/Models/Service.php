<?php

namespace App\Models;

use App\Models\Concerns\HasOptimisedImages;
use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

#[Fillable([
    'title', 'slug', 'short_description', 'description', 'capabilities', 'image', 'image_alt',
    'is_featured', 'sort_order', 'seo_title', 'seo_description', 'published_at',
])]
class Service extends Model implements HasMedia
{
    use HasOptimisedImages, Publishable;

    protected function casts(): array
    {
        return [
            'capabilities' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /** @param Builder<static> $query */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /** @param Builder<static> $query */
    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('sort_order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** @return array<string, string> */
    protected function imageColumns(): array
    {
        return [
            'image' => 'image',
        ];
    }
}
