<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Exports\ReceiverExporter;
use App\Filament\Imports\ReceiverImporter;
use App\Filament\Resources\ReceiverResource;
use Filament\Resources\Pages\ListRecords;

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
}
