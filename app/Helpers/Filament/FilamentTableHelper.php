<?php

namespace App\Helpers\Filament;

use Exception;
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

    public function authorSelectFilter(string $name, string $titleAttribute = 'name'): SelectFilter
    {
        return $this->selectFilter($name)
            ->relationship($name, $titleAttribute)
            ->label(__('common.author'));
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
