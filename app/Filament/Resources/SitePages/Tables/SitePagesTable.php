<?php

namespace App\Filament\Resources\SitePages\Tables;

use App\Support\SitePageBlueprint;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SitePagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Page')
                    ->formatStateUsing(fn (string $state): string => SitePageBlueprint::all()[$state]['label'] ?? $state)
                    ->searchable(),
                TextColumn::make('title')->limit(60)->placeholder('-'),
                TextColumn::make('updated_at')->label('Last edited')->since()->sortable(),
            ])
            ->defaultSort('id')
            ->recordActions([EditAction::make()])
            ->modifyQueryUsing(fn ($query) => $query->whereIn('key', array_keys(SitePageBlueprint::all())));
    }
}
