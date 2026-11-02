<?php

namespace App\Filament\Pages;

use App\Models\HomepageSetting;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

/**
 * A page that edits the one settings row of a model (created on first save).
 */
abstract class SingletonSettingsPage extends Page
{
    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /** @return class-string<HomepageSetting|SiteSetting> */
    abstract protected static function modelClass(): string;

    /** @return array<int, mixed> */
    abstract protected function formComponents(): array;

    abstract protected static function canManage(): bool;

    public static function canAccess(): bool
    {
        return static::canManage();
    }

    public function mount(): void
    {
        abort_unless(static::canManage(), 403);

        $this->getSchema('form')->fill(static::modelClass()::current()->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components($this->formComponents())->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')->label('Save changes')->submit('save'),
                    ]),
                ]),
        ]);
    }

    public function save(): void
    {
        abort_unless(static::canManage(), 403);

        $data = $this->getSchema('form')->getState();
        $class = static::modelClass();
        $record = $class::query()->first() ?? new $class;
        $record->fill($data)->save();

        Notification::make()->title('Saved')->success()->send();
    }
}
