<?php

namespace App\Filament\Resources\ContactEnquiries\Schemas;

use App\Enums\EnquiryStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;

class ContactEnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submitted enquiry')
                    ->description('Exactly as submitted through the website. These details cannot be edited.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->disabled()->dehydrated(false),
                        TextInput::make('email')->disabled()->dehydrated(false),
                        TextInput::make('phone')->disabled()->dehydrated(false),
                        TextInput::make('organisation')->disabled()->dehydrated(false),
                        TextInput::make('service')->label('Service requested')->disabled()->dehydrated(false),
                        TextInput::make('project_location')->disabled()->dehydrated(false),
                        Textarea::make('message')->rows(8)->disabled()->dehydrated(false)->columnSpanFull(),
                        TextInput::make('created_at')
                            ->label('Submitted')
                            ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('j M Y, H:i') : null)
                            ->disabled()
                            ->dehydrated(false),
                    ]),
                Section::make('Handling')
                    ->schema([
                        Select::make('status')
                            ->options(collect(EnquiryStatus::cases())->mapWithKeys(fn (EnquiryStatus $s) => [$s->value => $s->label()])->all())
                            ->required(),
                        Textarea::make('internal_notes')->rows(4)->maxLength(5000)->helperText('Never shown publicly.'),
                    ]),
            ]);
    }
}
