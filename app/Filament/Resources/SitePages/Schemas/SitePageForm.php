<?php

namespace App\Filament\Resources\SitePages\Schemas;

use App\Models\SitePage;
use App\Support\SitePageBlueprint;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SitePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make(fn (?SitePage $record): array => self::sections($record?->key ?? ''))->columnSpanFull(),
        ]);
    }

    /** @return array<int, Section> */
    private static function sections(string $key): array
    {
        $definition = SitePageBlueprint::all()[$key] ?? ['fields' => [], 'extra' => []];
        $fields = $definition['fields'];
        $sections = [];

        $main = array_values(array_filter([
            array_key_exists('nav_label', $fields) ? TextInput::make('nav_label')->label('Menu and footer label')->maxLength(60) : null,
            array_key_exists('eyebrow', $fields) ? TextInput::make('eyebrow')->label('Small heading above the title')->maxLength(120) : null,
            array_key_exists('title', $fields) ? TextInput::make('title')->label('Page title')->maxLength(255)->columnSpanFull() : null,
            array_key_exists('intro', $fields) || $key === 'company' ? Textarea::make('intro')->label('Introduction')->rows(3)->maxLength(1000)->columnSpanFull() : null,
        ]));

        if ($main !== []) {
            $sections[] = Section::make('Page header')->columns(2)->schema($main);
        }

        if ($key === 'privacy') {
            $sections[] = Section::make('Policy text')
                ->description('The privacy page and its footer link only appear once this has content. Have the wording reviewed before publishing.')
                ->schema([
                    Textarea::make('body')->label('Policy')->helperText('Plain text. Leave a blank line between paragraphs.')->rows(24)->columnSpanFull(),
                ]);
        }

        if (array_key_exists('seo_title', $fields)) {
            $sections[] = Section::make('Search and sharing')->collapsed()->columns(1)->schema([
                TextInput::make('seo_title')->label('SEO title')->maxLength(70),
                Textarea::make('seo_description')->label('SEO description')->rows(2)->maxLength(300),
            ]);
        }

        if ($definition['extra'] !== []) {
            $sections[] = Section::make('Labels and headings')
                ->description('Leave a field empty to use the standard wording.')
                ->columns(2)
                ->schema(collect($definition['extra'])->map(
                    fn (array $field, string $name) => TextInput::make('extra.'.$name)->label($field[0])->placeholder($field[1])->maxLength(300)
                )->values()->all());
        }

        return $sections;
    }
}
