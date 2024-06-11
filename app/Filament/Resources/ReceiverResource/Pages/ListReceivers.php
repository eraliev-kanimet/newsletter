<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Exports\ReceiverExporter;
use App\Filament\Resources\ReceiverResource;
use Filament\Resources\Pages\ListRecords;

class ListReceivers extends ListRecords
{
    protected static string $resource = ReceiverResource::class;

    protected function getHeaderActions(): array
    {
        $helper = filamentActionHelper();

        return [
            $helper->exportAction(ReceiverExporter::class)
                ->label(__('common.export_receivers'))
                ->pluralModelLabel(__('common.+receivers')),
            $helper->createAction(),
        ];
    }
}
