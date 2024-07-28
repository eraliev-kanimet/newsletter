<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Exports\ReceiverExporter;
use App\Filament\Imports\ReceiverImporter;
use App\Filament\Resources\ReceiverResource;
use App\Models\Receiver;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListReceivers extends ListRecords
{
    protected static string $resource = ReceiverResource::class;

    protected function getHeaderActions(): array
    {
        $helper = filamentActionHelper();

        return [
            $helper->importAction(ReceiverImporter::class)
                ->label(__('common.import_receivers'))
                ->pluralModelLabel(__('common.+receivers')),
            $helper->exportAction(ReceiverExporter::class)
                ->label(__('common.export_receivers'))
                ->pluralModelLabel(__('common.+receivers')),
            $helper->createAction(),
        ];
    }

    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();
        $action = filamentTableActionHelper();

        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['user']))
            ->columns([
                $helper->icon('is_active')
                    ->width(85)
                    ->label(__('common.active'))
                    ->alignCenter()
                    ->boolean(),
                $helper->text('user.name')
                    ->width(220)
                    ->label(__('common.author')),
                $helper->text('data')
                    ->label(__('common.data'))
                    ->formatStateUsing(function (Receiver $receiver) {
                        $text = '';

                        foreach ($receiver->data as $key => $value) {
                            $text .= __("common.$key") . ': ' . $value . ', ';
                        }

                        return trim($text, ', ');
                    }),
                $helper->created()
                    ->sortable(),
                $helper->updated()
                    ->sortable(),
            ])
            ->filters([
                $helper->authorSelectFilter('user'),
                $helper->isActiveFilter(),
            ])
            ->actions([
                $action->editAction(),
            ])
            ->bulkActions([
                $action->deleteBulkAction(),
            ]);
    }
}
