<?php

use App\Helpers\Filament\FilamentFormHelper;
use App\Helpers\Filament\FilamentTableHelper;

function filamentFormHelper(): FilamentFormHelper
{
    return new FilamentFormHelper;
}

function filamentTableHelper(): FilamentTableHelper
{
    return new FilamentTableHelper;
}
