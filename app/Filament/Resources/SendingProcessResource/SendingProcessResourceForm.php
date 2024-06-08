<?php

namespace App\Filament\Resources\SendingProcessResource;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class SendingProcessResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        $now = now();

        return [
            $helper->select('message_id')
                ->label(__('common.message'))
                ->relationship(
                    'message',
                    'subject',
                    fn(Builder $query) => $query->where('user_id', Auth::user()->id)
                ),
            $helper->dateTime('when')
                ->label(__('common.when'))
                ->default($now->minute(15))
                ->minDate($now->minute(15)),
            $helper->checkbox('receivers')
                ->label(__('common.receivers'))
                ->relationship(
                    titleAttribute: 'email',
                    modifyQueryUsing: fn(Builder $query) => $query->where('user_id', Auth::user()->id)
                )
                ->required()
                ->searchable()
                ->bulkToggleable()
                ->columns(),
        ];
    }

    public static function modifyBeforeCreate(): callable
    {
        return function (array $data): array {
            $data['user_id'] = Auth::user()->id;

            return $data;
        };
    }
}
