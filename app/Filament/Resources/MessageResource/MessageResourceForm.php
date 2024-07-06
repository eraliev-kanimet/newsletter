<?php

namespace App\Filament\Resources\MessageResource;

use Filament\Forms\Get;

class MessageResourceForm
{
    public static function form(string $text = 'text', string $html = 'html', string $prefix = 'data.'): array
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
                ->notRegex('/<\s*(script|style)[^>]*?>.*?<\s*\/\s*\1\s*>/is')
                ->required(fn (Get $get) => is_null($get($html)) || $get($html) === ''),
            $helper->aceEditor($html)
                ->label('HTML')
                ->reactive()
                ->notRegex('/<\s*(script|style)[^>]*?>.*?<\s*\/\s*\1\s*>/is')
                ->required(fn (Get $get) => is_null($get($text)) || $get($text) === ''),
        ];
    }
}
