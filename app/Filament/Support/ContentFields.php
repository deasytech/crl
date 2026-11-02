<?php

namespace App\Filament\Support;

use Filament\Actions\BulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

/** Field and column definitions shared by the content resources. */
class ContentFields
{
    public const IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

    public const MAX_IMAGE_KB = 5120;

    /** Image upload on the public disk: JPEG, PNG or WebP, up to 5 MB. */
    public static function image(string $name, string $directory, string $label = 'Image'): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('public')
            ->directory($directory)
            ->visibility('public')
            ->image()
            ->acceptedFileTypes(self::IMAGE_TYPES)
            ->maxSize(self::MAX_IMAGE_KB)
            ->imageEditor()
            ->helperText('JPEG, PNG or WebP, up to 5 MB.');
    }

    public static function title(string $name = 'title', string $label = 'Title'): TextInput
    {
        return TextInput::make($name)
            ->label($label)
            ->required()
            ->maxLength(255)
            ->live(onBlur: true)
            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, string $operation): void {
                if ($operation === 'create' && blank($get('slug'))) {
                    $set('slug', Str::slug((string) $state));
                }
            });
    }

    public static function slug(string $table): TextInput
    {
        return TextInput::make('slug')
            ->required()
            ->maxLength(255)
            ->alphaDash()
            ->unique($table, 'slug', ignoreRecord: true)
            ->helperText('Used in the page address. Changing it breaks existing links.');
    }

    public static function publishedAt(): DateTimePicker
    {
        return DateTimePicker::make('published_at')
            ->label('Publish at')
            ->helperText('Leave empty to keep this as a draft. A future date schedules it. Only published items appear on the website.');
    }

    public static function stateColumn(): TextColumn
    {
        return TextColumn::make('published_at')
            ->label('State')
            ->badge()
            ->state(fn ($record): string => $record->publicationState())
            ->color(fn (string $state): string => match ($state) {
                'Published' => 'success',
                'Scheduled' => 'info',
                default => 'gray',
            })
            ->sortable();
    }

    /** @return list<BulkAction> */
    public static function publishBulkActions(): array
    {
        return [
            BulkAction::make('publish')
                ->label('Publish now')
                ->icon('heroicon-o-eye')
                ->requiresConfirmation()
                ->action(fn (Collection $records) => $records->each->update(['published_at' => now()]))
                ->deselectRecordsAfterCompletion(),
            BulkAction::make('unpublish')
                ->label('Move to draft')
                ->icon('heroicon-o-eye-slash')
                ->requiresConfirmation()
                ->action(fn (Collection $records) => $records->each->update(['published_at' => null]))
                ->deselectRecordsAfterCompletion(),
        ];
    }
}
