<?php

use App\Helpers\Filament\FilamentTableActionHelper;
use App\Helpers\Filament\FilamentActionHelper;
use App\Helpers\Filament\FilamentFormHelper;
use App\Helpers\Filament\FilamentInfoHelper;
use App\Helpers\Filament\FilamentTableHelper;

function filamentFormHelper(): FilamentFormHelper
{
    return new FilamentFormHelper;
}

function filamentTableHelper(): FilamentTableHelper
{
    return new FilamentTableHelper;
}

function filamentInfoHelper(): FilamentInfoHelper
{
    return new FilamentInfoHelper;
}

function filamentActionHelper(): FilamentActionHelper
{
    return new FilamentActionHelper;
}

function filamentTableActionHelper(): FilamentTableActionHelper
{
    return new FilamentTableActionHelper;
}
