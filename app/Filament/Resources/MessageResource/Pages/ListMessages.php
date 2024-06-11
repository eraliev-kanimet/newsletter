<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();
        $action = filamentTableActionHelper();

        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['user']))
            ->columns([
                $helper->text('user.name')
                    ->width(250)
                    ->label(__('common.author')),
                $helper->text('subject')
                    ->label(__('common.subject'))
                    ->searchable(),
                $helper->deleted(),
                $helper->created()
                    ->sortable(),
                $helper->updated()
                    ->sortable(),
            ])
            ->filters([
                $helper->authorSelectFilter('user'),
                $helper->trashedFilter(),
            ])
            ->actions([
                $action->editAction(),
                $action->deleteAction(),
                $action->restoreAction(),
                $action->forceDeleteAction(),
            ])
            ->bulkActions([
                $action->deleteBulkAction(),
                $action->deleteBulkAction(),
            ]);
    }
}
