<?php

namespace App\Filament\Resources\ContactEnquiries\Tables;

use App\Enums\EnquiryStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactEnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Submitted')->dateTime('j M Y, H:i')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('service')->toggleable(),
                TextColumn::make('project_location')->label('Location')->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (EnquiryStatus $state): string => $state->label())
                    ->color(fn (EnquiryStatus $state): string => match ($state) {
                        EnquiryStatus::New => 'danger',
                        EnquiryStatus::InProgress => 'warning',
                        EnquiryStatus::Responded => 'success',
                        EnquiryStatus::Closed => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(EnquiryStatus::cases())->mapWithKeys(fn (EnquiryStatus $s) => [$s->value => $s->label()])->all()),
            ])
            ->recordActions([EditAction::make()->label('Open')])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
