<?php

namespace App\Helpers\Filament;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class FilamentTableHelper
{
    public function text(string $column): TextColumn
    {
        return TextColumn::make($column);
    }

    public function icon(string $column): IconColumn
    {
        return IconColumn::make($column);
    }

    public function toggle(string $column): ToggleColumn
    {
        return ToggleColumn::make($column);
    }

    public function action(string $name): Action
    {
        return Action::make($name);
    }

    public function createAction(): CreateAction
    {
        return CreateAction::make();
    }

    public function editAction(): EditAction
    {
        return EditAction::make();
    }

    public function viewAction(): ViewAction
    {
        return ViewAction::make();
    }

    public function deleteAction(): DeleteAction
    {
        return DeleteAction::make();
    }

    public function deleteBulkAction(): DeleteBulkAction
    {
        return DeleteBulkAction::make();
    }
}
