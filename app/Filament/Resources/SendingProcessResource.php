<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SendingProcessResource\Pages;
use App\Filament\Resources\SendingProcessResource\Schemas\SendingProcessResourceForm;
use App\Models\SendingProcess;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class SendingProcessResource extends Resource
{
    protected static ?string $model = SendingProcess::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    public static function getEloquentQuery(): Builder
    {
        return filamentRoleFiltering(parent::getEloquentQuery());
    }

    public static function getNavigationLabel(): string
    {
        return __('common.sending_processes');
    }

    public static function getPluralLabel(): string
    {
        return __('common.sending_processes');
    }

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
            'create' => Pages\CreateSendingProcess::route('/create'),
            'edit' => Pages\EditSendingProcess::route('/{record}/edit'),
        ];
    }
}
