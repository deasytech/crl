<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Enums\TeamGroup;
use App\Filament\Support\ContentFields;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Person')
                    ->columns(2)
                    ->schema([
                        ContentFields::title('name', 'Name')->columnSpanFull(),
                        ContentFields::slug('team_members'),
                        Select::make('group')
                            ->label('Classification')
                            ->options(collect(TeamGroup::cases())->mapWithKeys(fn (TeamGroup $g) => [$g->value => $g->label()])->all())
                            ->default(TeamGroup::Core->value)
                            ->required(),
                        TextInput::make('designation')->maxLength(255),
                        TextInput::make('professional_category')->maxLength(255)->placeholder('e.g. Architect, Quantity Surveyor'),
                        TextInput::make('qualifications')->maxLength(255)->columnSpanFull(),
                        Textarea::make('biography')
                            ->rows(8)
                            ->maxLength(10000)
                            ->helperText('Plain text. Only enter confirmed biographical facts.')
                            ->columnSpanFull(),
                        ContentFields::image('portrait', 'team', 'Portrait')->columnSpanFull(),
                    ]),
                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        ContentFields::publishedAt(),
                        Toggle::make('is_featured')->label('Featured')->inline(false),
                        TextInput::make('sort_order')->numeric()->default(0)->minValue(0)->helperText('Lower numbers appear first.'),
                    ]),
                Section::make('Internal notes')
                    ->collapsed()
                    ->schema([
                        Textarea::make('admin_notes')->rows(3)->helperText('Never shown publicly.'),
                    ]),
            ]);
    }
}
