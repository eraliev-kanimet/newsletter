<?php

namespace App\Helpers\Filament;

use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;

class FilamentActionHelper
{
    public function createAction(): CreateAction
    {
        return CreateAction::make();
    }

    public function exportAction(string $exporter): ExportAction
    {
        return ExportAction::make()->exporter($exporter);
    }

    public function importAction(string $importer): ImportAction
    {
        return ImportAction::make()->importer($importer);
    }
}
