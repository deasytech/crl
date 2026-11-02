<?php

namespace App\Models;

use App\Models\Concerns\HasOptimisedImages;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

#[Fillable(['project_id', 'path', 'alt', 'caption', 'kind', 'source_note', 'sort_order'])]
class ProjectImage extends Model implements HasMedia
{
    use HasOptimisedImages;

    /** @return BelongsTo<Project, $this> */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /** @return array<string, string> */
    protected function imageColumns(): array
    {
        return [
            'path' => 'image',
        ];
    }
}
