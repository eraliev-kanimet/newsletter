<?php

namespace App\Helpers\Filament;

use Filament\Actions\Imports\ImportColumn;

class FilamentImportHelper
{
    public function column(string $name): ImportColumn
    {
        return ImportColumn::make($name);
    }
}
