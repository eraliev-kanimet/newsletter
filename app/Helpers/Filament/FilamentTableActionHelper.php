<?php

namespace App\Helpers\Filament;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ViewAction;

class FilamentTableActionHelper
{
    public function action(string $name): Action
    {
        return Action::make($name);
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

    public function forceDeleteAction(): ForceDeleteAction
    {
        return ForceDeleteAction::make();
    }

    public function restoreAction(): RestoreAction
    {
        return RestoreAction::make();
    }

    public function actionGroup(array $actions): ActionGroup
    {
        return ActionGroup::make($actions);
    }

    public function bulkAction(string $name): BulkAction
    {
        return BulkAction::make($name);
    }

    public function deleteBulkAction(): DeleteBulkAction
    {
        return DeleteBulkAction::make();
    }
}
