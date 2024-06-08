<?php

namespace App\Helpers\Filament;

use Filament\Infolists\Components\TextEntry;

class FilamentInfoHelper
{
    public function textEntry(string $model): TextEntry
    {
        return TextEntry::make($model);
    }
}
