<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use App\Filament\Support\ContentFields;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project')
                    ->columns(2)
                    ->schema([
                        ContentFields::title()->columnSpanFull(),
                        ContentFields::slug('projects'),
                        Select::make('project_category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('location')->maxLength(255),
                        TextInput::make('year_label')
                            ->label('Year or date range')
                            ->placeholder('e.g. 2019 or 2018–2021')
                            ->maxLength(255),
                        TextInput::make('year_start')
                            ->label('Start year (for ordering)')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(2100),
                        Select::make('status')
                            ->options(collect(ProjectStatus::cases())->mapWithKeys(fn (ProjectStatus $s) => [$s->value => $s->label()])->all())
                            ->default(ProjectStatus::Unspecified->value)
                            ->required()
                            ->helperText('Only mark a project as completed, ongoing or stalled when this is confirmed.'),
                        TextInput::make('crl_involvement')
                            ->label('CRL involvement')
                            ->placeholder('e.g. Architectural design and supervision')
                            ->maxLength(255),
                        Textarea::make('summary')->rows(3)->maxLength(1000)->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(10)
                            ->maxLength(20000)
                            ->helperText('Plain text. Leave a blank line between paragraphs.')
                            ->columnSpanFull(),
                    ]),
                Section::make('Main image')
                    ->columns(2)
                    ->schema([
                        ContentFields::image('main_image', 'projects', 'Main image'),
                        TextInput::make('main_image_alt')
                            ->label('Alt text')
                            ->helperText('Describe the image for screen readers. Say if it is a render or a photograph.')
                            ->maxLength(255),
                    ]),
                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        ContentFields::publishedAt(),
                        Toggle::make('is_featured')->label('Featured on the homepage')->inline(false),
                        TextInput::make('sort_order')->numeric()->default(0)->minValue(0)->helperText('Lower numbers appear first.'),
                    ]),
                Section::make('SEO')
                    ->collapsed()
                    ->columns(1)
                    ->schema([
                        TextInput::make('seo_title')->maxLength(70),
                        Textarea::make('seo_description')->rows(2)->maxLength(160),
                    ]),
                Section::make('Internal notes')
                    ->collapsed()
                    ->schema([
                        Textarea::make('admin_notes')->rows(3)->helperText('Never shown publicly. Use for items needing client confirmation.'),
                    ]),
            ]);
    }
}
