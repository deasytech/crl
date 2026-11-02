<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Support\ContentFields;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Gallery';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                ContentFields::image('path', 'projects/gallery', 'Image')->required(),
                TextInput::make('alt')->label('Alt text')->maxLength(255),
                TextInput::make('caption')->maxLength(255),
                Select::make('kind')
                    ->options(['gallery' => 'Gallery', 'before' => 'Before', 'after' => 'After', 'render' => 'Design render'])
                    ->default('gallery')
                    ->required(),
                TextInput::make('source_note')->label('Source / credit')->maxLength(255),
                TextInput::make('sort_order')->numeric()->default(0)->minValue(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                ImageColumn::make('path')->disk('public')->label('')->square(),
                TextColumn::make('caption')->placeholder('—'),
                TextColumn::make('kind')->badge(),
                TextColumn::make('sort_order')->label('Order'),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
