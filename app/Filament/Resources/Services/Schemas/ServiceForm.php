<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Support\ContentFields;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service')
                    ->columns(2)
                    ->schema([
                        ContentFields::title()->columnSpanFull(),
                        ContentFields::slug('services'),
                        Textarea::make('short_description')->rows(3)->maxLength(500)->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(10)
                            ->maxLength(20000)
                            ->helperText('Plain text. Leave a blank line between paragraphs.')
                            ->columnSpanFull(),
                        TagsInput::make('capabilities')
                            ->helperText('Press Enter after each capability.')
                            ->columnSpanFull(),
                    ]),
                Section::make('Image')
                    ->columns(2)
                    ->schema([
                        ContentFields::image('image', 'services'),
                        TextInput::make('image_alt')->label('Alt text')->maxLength(255),
                    ]),
                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        ContentFields::publishedAt(),
                        Toggle::make('is_featured')->label('Show on the homepage')->default(true)->inline(false),
                        TextInput::make('sort_order')->numeric()->default(0)->minValue(0)->helperText('Lower numbers appear first.'),
                    ]),
                Section::make('SEO')
                    ->collapsed()
                    ->schema([
                        TextInput::make('seo_title')->maxLength(70),
                        Textarea::make('seo_description')->rows(2)->maxLength(160),
                    ]),
            ]);
    }
}
