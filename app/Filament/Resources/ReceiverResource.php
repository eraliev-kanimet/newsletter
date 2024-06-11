<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceiverResource\Pages;
use App\Filament\Resources\ReceiverResource\ReceiverResourceForm;
use App\Models\Receiver;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class ReceiverResource extends Resource
{
    protected static ?string $model = Receiver::class;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    public static function getNavigationLabel(): string
    {
        return __('common.receivers');
    }

    public static function getPluralLabel(): string
    {
        return __('common.receivers');
    }

    public static function form(Form $form): Form
    {
        return parent::form($form)
            ->schema(ReceiverResourceForm::form())
            ->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReceivers::route('/'),
            'create' => Pages\CreateReceiver::route('/create'),
            'edit' => Pages\EditReceiver::route('/{record}/edit'),
        ];
    }
}
