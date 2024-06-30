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

        $textarea = function (string $model, string $alterModel, string $label) use ($helper) {
            return $helper->textarea($model)
                ->label($label)
                ->reactive()
                ->rows(6)
                ->notRegex('/.(<script|<style>).+/i')
                ->required(fn (Get $get) => is_null($get($alterModel)) || $get($alterModel) === '');
        };

        return [
            $helper->input($prefix . 'subject')
                ->label(__('common.subject'))
                ->required(),
            $textarea($text, $html, __('common.text')),
            $textarea($html, $text, 'HTML'),
        ];
    }
}
