<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\MessageResourceForm;
use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(MessageResourceForm::form())
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        $helper = filamentTableHelper();

        return $table
            ->columns([
                $helper->text('user.name')
                    ->width(250)
                    ->label(__('common.owner')),
                $helper->text('subject')
                    ->label(__('common.subject')),
            ])
            ->actions([
                $helper->editAction(),
            ])
            ->bulkActions([
                $helper->deleteBulkAction(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
