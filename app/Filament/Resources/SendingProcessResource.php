<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SendingProcessResource\Pages;
use App\Filament\Resources\SendingProcessResource\SendingProcessResourceSchema;
use App\Models\SendingProcess;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SendingProcessResource extends Resource
{
    protected static ?string $model = SendingProcess::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
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
            ->schema(SendingProcessResourceSchema::form())
            ->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSendingProcesses::route('/'),
        ];
    }
}
