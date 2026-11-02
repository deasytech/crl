<?php

namespace App\Models;

use App\Enums\TeamGroup;
use App\Models\Concerns\HasOptimisedImages;
use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

#[Fillable([
    'name', 'slug', 'designation', 'qualifications', 'biography', 'portrait', 'group',
    'professional_category', 'is_featured', 'sort_order', 'admin_notes', 'published_at',
])]
class TeamMember extends Model implements HasMedia
{
    use HasOptimisedImages, Publishable;

    protected function casts(): array
    {
        return [
            'group' => TeamGroup::class,
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
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
            'portrait' => 'portrait',
        ];
    }
}
