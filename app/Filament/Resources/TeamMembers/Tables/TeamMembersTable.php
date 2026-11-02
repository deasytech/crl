<?php

namespace App\Filament\Resources\TeamMembers\Tables;

use App\Enums\TeamGroup;
use App\Filament\Support\ContentFields;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TeamMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('portrait')->disk('public')->label('')->circular(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('designation')->searchable()->wrap(),
                TextColumn::make('group')
                    ->label('Classification')
                    ->badge()
                    ->formatStateUsing(fn (TeamGroup $state): string => $state->label()),
                TextColumn::make('professional_category')->label('Category')->toggleable(),
                ContentFields::stateColumn(),
                TextColumn::make('sort_order')->label('Order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('group')
                    ->label('Classification')
                    ->options(collect(TeamGroup::cases())->mapWithKeys(fn (TeamGroup $g) => [$g->value => $g->label()])->all()),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ...ContentFields::publishBulkActions(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
