<?php

namespace App\Helpers\Filament;

use Exception;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

    public function created(): TextColumn
    {
        return $this->text('created_at')
            ->label(__('common.created_at'))
            ->alignCenter();
    }

    public function updated(): TextColumn
    {
        return $this->text('updated_at')
            ->label(__('common.updated_at'))
            ->alignCenter();
    }

    public function deleted(): TextColumn
    {
        return $this->text('deleted_at')
            ->default('')
            ->label(__('common.deleted'))
            ->alignCenter()
            ->formatStateUsing(function (Model $record) {
                return $record->trashed() ? __('common.yes') : __('common.no');
            })
            ->color(function (Model $record) {
                return $record->trashed() ? 'danger' : 'success';
            });
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

    public function selectFilter(string $name): SelectFilter
    {
        try {
            return SelectFilter::make($name);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function ternaryFilter(string $name): TernaryFilter
    {
        try {
            return TernaryFilter::make($name)->native(false);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function isActiveFilter(): TernaryFilter
    {
        return $this->ternaryFilter('is_active')
            ->label(__('common.active'))
            ->placeholder(__('common.all'))
            ->trueLabel(__('common.active'))
            ->falseLabel(__('common.inactive'));
    }

    public function trashedFilter(): TernaryFilter
    {
        return $this->ternaryFilter('deleted_at')
            ->label(__('common.deleted'))
            ->placeholder(__('common.all'))
            ->trueLabel(__('common.deleted'))
            ->falseLabel(__('common.undeleted'))
            ->queries(
                true: fn(Builder $query) => $query->whereNotNull('deleted_at'),
                false: fn(Builder $query) => $query->whereNull('deleted_at'),
                blank: fn(Builder $query) => $query,
            );
    }
}
