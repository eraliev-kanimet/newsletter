<?php

namespace App\Filament\Resources\MessageResource;

use Filament\Forms\Get;

class MessageResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        return [
            $helper->input('subject')
                ->label(__('common.subject'))
                ->required(),
            $helper->textarea('message.text')
                ->label(__('common.text'))
                ->reactive()
                ->rows(6)
                ->required(function (Get $get) {
                    return is_null($get('message.html')) || $get('message.html') === '';
                }),
            $helper->richEditor('message.html')
                ->label('HTML')
                ->reactive()
                ->required(function (Get $get) {
                    return is_null($get('message.text')) || $get('message.text') === '';
                }),
        ];
    }
}
