<?php

namespace App\Models\Concerns;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Content is public only when published_at is set and not in the future.
 *
 * @property CarbonInterface|null $published_at
 */
trait Publishable
{
    /** @param Builder<static> $query */
    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull($this->qualifyColumn('published_at'))
            ->where($this->qualifyColumn('published_at'), '<=', now());
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->lte(now());
    }
}
