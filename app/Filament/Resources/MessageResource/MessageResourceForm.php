<?php

namespace App\Filament\Resources\MessageResource;

use Filament\Forms\Get;

class MessageResourceForm
{
    public static function form(string $text = 'data.text', string $html = 'data.html', string $prefix = ''): array
    {
        $helper = filamentFormHelper();

        $text = $prefix . $text;
        $html = $prefix . $html;

        return [
            $helper->input($prefix . 'subject')
                ->label(__('common.subject'))
                ->required(),
            $helper->textarea($text)
                ->label(__('common.text'))
                ->reactive()
                ->rows(6)
                ->required(function (Get $get) use ($html) {
                    return is_null($get($html)) || $get($html) === '';
                }),
            $helper->richEditor($html)
                ->label('HTML')
                ->reactive()
                ->required(function (Get $get) use ($text) {
                    return is_null($get($text)) || $get($text) === '';
                }),
        ];
    }
}
