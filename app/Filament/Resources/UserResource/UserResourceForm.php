<?php

namespace App\Filament\Resources\UserResource;

use Illuminate\Database\Eloquent\Model;

class UserResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        return [
            $helper->toggle('is_active')
                ->label(__('common.active'))
                ->default(true)
                ->columnSpanFull(),
            $helper->input('email')
                ->label(__('common.email'))
                ->required()
                ->email()
                ->unique(ignorable: fn(?Model $record): ?Model => $record),
            $helper->input('name')
                ->label(__('common.name'))
                ->required()
                ->unique(ignorable: fn(?Model $record): ?Model => $record),
            $helper->input('password')
                ->label(__('common.password'))
                ->required(fn(?Model $record): bool => is_null($record))
                ->password()
                ->maxLength(255),
        ];
    }
}
