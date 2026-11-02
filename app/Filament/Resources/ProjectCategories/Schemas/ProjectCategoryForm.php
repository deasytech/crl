<?php

namespace App\Filament\Resources\ProjectCategories\Schemas;

use App\Filament\Support\ContentFields;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ContentFields::title('name', 'Name'),
                ContentFields::slug('project_categories'),
                TextInput::make('sort_order')->numeric()->default(0)->minValue(0),
            ]);
    }
}
