<?php

namespace App\Models;

use App\Support\SitePageBlueprint;
use Database\Factories\SitePageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'nav_label', 'eyebrow', 'title', 'intro', 'seo_title', 'seo_description', 'body', 'extra'])]
final class SitePage extends Model
{
    /** @use HasFactory<SitePageFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return ['extra' => 'array'];
    }

    /** The page for a key, with shipped wording filling any blank field. Never saved by this call. */
    public static function get(string $key): self
    {
        $page = self::query()->where('key', $key)->first() ?? new self(['key' => $key]);

        return $page->withDefaults();
    }

    /** Navigation labels keyed by page key, e.g. ['company' => 'The Company']. @return array<string, string> */
    public static function navLabels(): array
    {
        $stored = self::query()->pluck('nav_label', 'key');

        return collect(SitePageBlueprint::all())
            ->mapWithKeys(fn (array $definition, string $key): array => [$key => $stored->get($key) ?: ($definition['fields']['nav_label'] ?? '')])
            ->all();
    }

    public function text(string $name): string
    {
        return (string) ($this->extra[$name] ?? '');
    }

    public function withDefaults(): self
    {
        $definition = SitePageBlueprint::all()[$this->key] ?? null;

        if ($definition === null) {
            return $this;
        }

        foreach ($definition['fields'] as $field => $default) {
            if (blank($this->{$field})) {
                $this->{$field} = $default;
            }
        }

        $extra = $this->extra ?? [];

        foreach ($definition['extra'] as $name => [, $default]) {
            if (blank($extra[$name] ?? null)) {
                $extra[$name] = $default;
            }
        }

        $this->extra = $extra;

        return $this;
    }
}
