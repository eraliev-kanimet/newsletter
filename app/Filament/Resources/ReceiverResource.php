<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceiverResource\Pages;
use App\Filament\Resources\ReceiverResource\ReceiverResourceForm;
use App\Models\Receiver;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

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

    public static function table(Table $table): Table
    {
        $helper = filamentTableHelper();

        return $table
            ->columns([
                $helper->icon('is_active')
                    ->width(85)
                    ->label(__('common.active'))
                    ->alignCenter()
                    ->boolean(),
                $helper->text('user.name')
                    ->width(220)
                    ->label(__('common.author')),
                $helper->text('email')
                    ->width(220)
                    ->searchable()
                    ->label(__('common.email')),
                $helper->text('data')
                    ->hidden()
                    ->label(__('common.data'))
                    ->formatStateUsing(function (Receiver $receiver) {
                        $text = '';

                        foreach ($receiver->data as $key => $value) {
                            $text .= __("common.$key") . ': ' . $value . ', ';
                        }

                        return trim($text, ', ');
                    }),
                $helper->created()
                    ->sortable(),
                $helper->updated()
                    ->sortable(),
            ])
            ->filters([
                $helper->selectFilter('user')
                    ->relationship('user', 'name')
                    ->label(__('common.author')),
                $helper->isActiveFilter(),
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
            'index' => Pages\ListReceivers::route('/'),
            'create' => Pages\CreateReceiver::route('/create'),
            'edit' => Pages\EditReceiver::route('/{record}/edit'),
        ];
    }
}
