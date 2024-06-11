<?php

namespace App\Helpers\Filament;

use Filament\Actions\Exports\ExportColumn;

class FilamentExportHelper
{
    public function column(string $name): ExportColumn
    {
        return ExportColumn::make($name);
    }

    public function columnTernary(string $name): ExportColumn
    {
        return $this->column($name)->formatStateUsing(fn(int $state) => $state ? __('common.yes') : __('common.no'));
    }
}
