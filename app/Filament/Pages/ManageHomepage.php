<?php

namespace App\Filament\Pages;

use App\Filament\Support\ContentFields;
use App\Models\HomepageSetting;
use App\Models\User;
use BackedEnum;
use Closure;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;

class ManageHomepage extends SingletonSettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 0;

    protected static ?string $title = 'Homepage';

    protected static ?string $slug = 'homepage';

    protected static function modelClass(): string
    {
        return HomepageSetting::class;
    }

    protected static function canManage(): bool
    {
        $user = auth()->user();

        return $user instanceof User && $user->role !== null;
    }

    /** Accepts a site path (/contact) or a full http(s) address. */
    public static function linkRule(): Closure
    {
        return fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
            if (filled($value) && ! preg_match('#^(/[^\s]*|https?://[^\s]+)$#', (string) $value)) {
                $fail('Enter a site path starting with / or a full http(s) address.');
            }
        };
    }

    protected function formComponents(): array
    {
        $link = fn (string $name, string $label) => TextInput::make($name)->label($label)->maxLength(255)->rule(self::linkRule());
        $items = fn (string $name, string $label) => Repeater::make($name)
            ->label($label)
            ->schema([
                TextInput::make('title')->required()->maxLength(255),
                Textarea::make('body')->required()->rows(3)->maxLength(1000),
            ])
            ->reorderable()
            ->collapsible()
            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
            ->defaultItems(0);

        return [
            Section::make('Hero')->columns(2)->schema([
                TextInput::make('hero_headline')->required()->maxLength(255)->columnSpanFull(),
                Textarea::make('hero_subheading')->rows(3)->maxLength(500)->columnSpanFull(),
                ContentFields::image('hero_image', 'homepage', 'Hero image'),
                TextInput::make('hero_image_alt')->label('Alt text')->maxLength(255),
                TextInput::make('primary_cta_label')->label('Primary button label')->maxLength(60),
                $link('primary_cta_url', 'Primary button destination'),
                TextInput::make('secondary_cta_label')->label('Secondary button label')->maxLength(60),
                $link('secondary_cta_url', 'Secondary button destination'),
            ]),
            Section::make('Introduction')->columns(2)->schema([
                TextInput::make('intro_heading')->maxLength(255)->columnSpanFull(),
                Textarea::make('intro_body')->rows(8)->maxLength(5000)->helperText('Plain text. Blank line between paragraphs.')->columnSpanFull(),
                ContentFields::image('intro_image', 'homepage', 'Introduction image'),
                TextInput::make('intro_image_alt')->label('Alt text')->maxLength(255),
            ]),
            Section::make('Content blocks')
                ->description('Featured projects and services are chosen by the "Featured" toggle on each project and service.')
                ->schema([
                    $items('highlights', 'Highlights'),
                    $items('approach_steps', 'Approach steps'),
                    $items('why_points', 'Why Custom Realities'),
                ]),
            Section::make('Closing call to action')->columns(2)->schema([
                TextInput::make('closing_heading')->maxLength(255)->columnSpanFull(),
                Textarea::make('closing_body')->rows(3)->maxLength(1000)->columnSpanFull(),
                TextInput::make('closing_cta_label')->maxLength(60),
                $link('closing_cta_url', 'Button destination'),
            ]),
        ];
    }
}
