<?php

namespace App\Filament\Resources\SendingProcessResource\Schemas;

use App\Filament\Resources\MessageResource\MessageResourceForm;
use App\Models\Message;
use App\Models\SendingProcess;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SendingProcessResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();
        $userId = Auth::user()->id;

        $isDisabled = fn(?SendingProcess $record) => $record && $record->status != 0;

        return [
            $helper->select('message_id')
                ->reactive()
                ->label(__('common.message'))
                ->options(Message::whereUserId($userId)->pluck('subject', 'id'))
                ->hidden(fn(?SendingProcess $record) => $record),
            $helper->grid(MessageResourceForm::form('text', 'html', 'message.'), 1)
                ->disabled($isDisabled)
                ->hidden(fn(Get $get) => !is_null($get('message_id'))),
            $helper->dateTime('when')
                ->disabled($isDisabled)
                ->label(__('common.when'))
                ->default(now()->addMinutes(30))
                ->minDate(now()),
            $helper->checkbox('receivers')
                ->disabled($isDisabled)
                ->label(__('common.receivers'))
                ->relationship(
                    titleAttribute: 'email',
                    modifyQueryUsing: fn(Builder $query) => $query->where('user_id', $userId)
                )
                ->required()
                ->searchable()
                ->bulkToggleable()
                ->columns(),
        ];
    }
}
