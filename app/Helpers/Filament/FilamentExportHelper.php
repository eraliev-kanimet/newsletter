<?php

namespace App\Helpers\Filament;

use Filament\Actions\Exports\ExportColumn;

class FilamentExportHelper
{
    public function column(string $name): ExportColumn
    {
        return ExportColumn::make($name);
    }
}
