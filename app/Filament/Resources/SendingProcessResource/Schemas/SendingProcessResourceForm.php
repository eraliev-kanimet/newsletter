<?php

namespace App\Filament\Resources\SendingProcessResource\Schemas;

use App\Filament\Resources\MessageResource\MessageResourceForm;
use App\Models\Message;
use App\Models\SendingProcess;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;

class SendingProcessResourceForm
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        $isDisabled = fn(?SendingProcess $record) => $record && $record->status != 0;

        return [
            $helper->tabs([
                $helper->tab(__('common.message'), [
                    $helper->select('message_id')
                        ->reactive()
                        ->label(__('common.message'))
                        ->options(filamentRoleFiltering(Message::query())->pluck('subject', 'id'))
                        ->hidden(fn(?SendingProcess $record) => $record),
                    $helper->grid(MessageResourceForm::form(prefix: 'message.'), 1)
                        ->disabled($isDisabled)
                        ->hidden(fn(Get $get) => !is_null($get('message_id'))),
                ]),
                $helper->tab(__('common.settings'), [
                    $helper->toggle('run_now')
                        ->default(false)
                        ->hidden(fn(?SendingProcess $record) => $record)
                        ->reactive()
                        ->label(__('common.run_now')),
                    $helper->dateTime('when')
                        ->hidden(fn(Get $get) => $get('run_now'))
                        ->disabled($isDisabled)
                        ->label(__('common.when'))
                        ->default(now()->addMinutes(30))
                        ->minDate(now()),
                    $helper->checkbox('receivers')
                        ->disabled($isDisabled)
                        ->label(__('common.receivers'))
                        ->relationship(
                            titleAttribute: 'email',
                            modifyQueryUsing: fn(Builder $query) => filamentRoleFiltering($query)
                        )
                        ->required()
                        ->searchable()
                        ->bulkToggleable()
                        ->columns(),
                ]),
            ]),
        ];
    }
}
