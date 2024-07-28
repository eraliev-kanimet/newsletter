<?php

use App\Helpers\Filament\FilamentExportHelper;
use App\Helpers\Filament\FilamentImportHelper;
use App\Helpers\Filament\FilamentNotificationHelper;
use App\Helpers\Filament\FilamentTableActionHelper;
use App\Helpers\Filament\FilamentActionHelper;
use App\Helpers\Filament\FilamentFormHelper;
use App\Helpers\Filament\FilamentInfoHelper;
use App\Helpers\Filament\FilamentTableHelper;

require_once 'queries.php';

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

function filamentExportHelper(): FilamentExportHelper
{
    return new FilamentExportHelper;
}

function filamentImportHelper(): FilamentImportHelper
{
    return new FilamentImportHelper;
}

function filamentNotificationHelper(): FilamentNotificationHelper
{
    return new FilamentNotificationHelper;
}
