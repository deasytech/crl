<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Models\Concerns\HasOptimisedImages;
use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;

#[Fillable([
    'project_category_id', 'title', 'slug', 'summary', 'description', 'location',
    'year_label', 'year_start', 'status', 'crl_involvement', 'is_featured', 'sort_order',
    'main_image', 'main_image_alt', 'seo_title', 'seo_description', 'admin_notes', 'published_at',
])]
class Project extends Model implements HasMedia
{
    use HasOptimisedImages, Publishable, SoftDeletes;

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<ProjectCategory, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    /** @return HasMany<ProjectImage, $this> */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    /** @param Builder<static> $query */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /** @param Builder<static> $query */
    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderByDesc('year_start');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** @return array<string, string> */
    protected function imageColumns(): array
    {
        return [
            'main_image' => 'main_image',
        ];
    }
}
