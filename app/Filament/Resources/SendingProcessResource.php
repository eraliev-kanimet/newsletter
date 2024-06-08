<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SendingProcessResource\Pages;
use App\Filament\Resources\SendingProcessResource\SendingProcessResourceForm;
use App\Models\SendingProcess;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class SendingProcessResource extends Resource
{
    protected static ?string $model = SendingProcess::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(SendingProcessResourceForm::form())
            ->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSendingProcesses::route('/'),
        ];
    }
}
