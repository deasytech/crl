<?php

namespace App\Filament\Pages;

use App\Filament\Support\ContentFields;
use App\Models\SiteSetting;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;

class ManageSiteSettings extends SingletonSettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $title = 'Company settings';

    protected static ?string $slug = 'site-settings';

    protected static function modelClass(): string
    {
        return SiteSetting::class;
    }

    /** Company-wide details and enquiry routing are admin-only. */
    protected static function canManage(): bool
    {
        $user = auth()->user();

        return $user instanceof User && $user->isAdmin();
    }

    protected function formComponents(): array
    {
        return [
            Section::make('Company')->columns(2)->schema([
                TextInput::make('company_name')->required()->maxLength(255),
                TextInput::make('registration_number')->maxLength(255),
                TextInput::make('tagline')->maxLength(255),
                TextInput::make('founded_year')->numeric()->minValue(1800)->maxValue(2100),
                TextInput::make('website_url')->url()->maxLength(255),
                Textarea::make('footer_text')->rows(2)->maxLength(500)->columnSpanFull(),
            ]),
            Section::make('Contact details')->columns(2)->schema([
                Textarea::make('address')->rows(3)->maxLength(500)->columnSpanFull(),
                TextInput::make('office_phone')->tel()->maxLength(50),
                TextInput::make('mobile_phone')->tel()->maxLength(50),
                TextInput::make('primary_email')->email()->maxLength(255)->helperText('Shown publicly.'),
                TextInput::make('enquiry_recipient')->email()->maxLength(255)->helperText('Where website enquiry notifications are sent. Not shown publicly.'),
            ]),
            Section::make('Social links')
                ->description('Add only accounts the company has confirmed.')
                ->schema([
                    Repeater::make('social_links')
                        ->schema([
                            TextInput::make('platform')->required()->maxLength(50),
                            TextInput::make('url')->label('Address')->url()->required()->maxLength(255),
                        ])
                        ->columns(2)
                        ->defaultItems(0),
                ]),
            Section::make('Company page')->schema([
                Textarea::make('vision')->rows(2)->maxLength(1000),
                Textarea::make('mission')->rows(2)->maxLength(1000),
                Textarea::make('about_body')->label('About')->rows(5)->maxLength(5000),
                Textarea::make('client_philosophy')->rows(6)->maxLength(5000),
                Textarea::make('client_relationships')->rows(4)->maxLength(5000),
                Textarea::make('team_philosophy')->rows(4)->maxLength(5000),
                Textarea::make('technical_expertise')->rows(4)->maxLength(5000),
            ]),
            Section::make('Site SEO and sharing')->collapsed()->columns(2)->schema([
                TextInput::make('seo_title')->maxLength(70),
                Textarea::make('seo_description')->rows(2)->maxLength(160),
                ContentFields::image('og_image', 'site', 'Social sharing image'),
            ]),
        ];
    }
}
