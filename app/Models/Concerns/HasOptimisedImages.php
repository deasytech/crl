<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Keeps Filament's plain path columns as the editable source of truth, and mirrors each
 * uploaded file into Spatie Media Library to generate WebP and responsive derivatives.
 * The original upload is never moved, changed or deleted.
 */
trait HasOptimisedImages
{
    use InteractsWithMedia;

    /** @return array<string, string> Path column => media collection name. */
    abstract protected function imageColumns(): array;

    protected static function bootHasOptimisedImages(): void
    {
        static::saved(fn (self $model) => $model->syncOptimisedImages());
    }

    public function syncOptimisedImages(): void
    {
        $this->unsetRelation('media');

        foreach ($this->imageColumns() as $column => $collection) {
            $path = $this->{$column};
            $existing = $this->getFirstMedia($collection);

            if (blank($path)) {
                if ($existing) {
                    $this->clearMediaCollection($collection);
                }

                continue;
            }

            if ($existing?->getCustomProperty('source') === $path || ! Storage::disk('public')->exists($path)) {
                continue;
            }

            $this->addMedia(Storage::disk('public')->path($path))
                ->preservingOriginal()
                ->withCustomProperties(['source' => $path])
                ->toMediaCollection($collection);

            $this->unsetRelation('media');
        }
    }

    public function optimisedImage(string $column): ?Media
    {
        $media = $this->getFirstMedia($this->imageColumns()[$column] ?? '');

        return $media?->hasGeneratedConversion('web') ? $media : null;
    }

    public function registerMediaCollections(): void
    {
        foreach ($this->imageColumns() as $collection) {
            $this->addMediaCollection($collection)->singleFile();
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $conversion = $this->addMediaConversion('web');
        $conversion->withResponsiveImages();
        $conversion->nonQueued();
        $conversion->format('webp')->width(1800)->quality(82);
    }
}
