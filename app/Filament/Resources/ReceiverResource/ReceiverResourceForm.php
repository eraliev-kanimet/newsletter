<?php

namespace App\Filament\Resources\ReceiverResource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class ReceiverResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        return [
            $helper->toggle('is_active')
                ->label(__('common.active'))
                ->default(true),
            $helper->input('data.name')
                ->label(__('common.name')),
            $helper->input('data.email')
                ->required()
                ->label(__('common.email'))
                ->email()
                ->unique(
                    column: 'data->email',
                    ignorable: fn(?Model $record): ?Model => $record,
                    modifyRuleUsing: function (Unique $rule) {
                        return $rule->where('user_id', Auth::user()->id);
                    }
                ),
        ];
    }

    public static function sanitizing(array $data): array
    {
        if (isset($data['data']) && is_array($data['data']) && count($data['data'])) {
            $data_data = [];

            foreach ($data['data'] as $key => $value) {
                if (strlen($key) && strlen($value)) {
                    $data_data[$key] = $value;
                }
            }

            $data['data'] = $data_data;
        }

        return $data;
    }
}
