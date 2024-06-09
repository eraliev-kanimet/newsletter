<?php

namespace App\Helpers\Filament;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;

class FilamentInfoHelper
{
    public function textEntry(string $model): TextEntry
    {
        return TextEntry::make($model);
    }

    public function repeatableEntry(string $model): RepeatableEntry
    {
        return RepeatableEntry::make($model);
    }
}
