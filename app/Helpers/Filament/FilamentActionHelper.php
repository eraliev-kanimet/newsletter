<?php

namespace App\Helpers\Filament;

use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;

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
}
