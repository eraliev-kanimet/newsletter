<?php

namespace App\Filament\Resources\SendingProcessResource;

use App\Enums\SendingProcessStatus as Status;
use App\Models\SendingProcess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class SendingProcessResourceSchema
{
    public static function form(): array
    {
        $helper = filamentFormHelper();

        $now = now();

        $disabled = function (?SendingProcess $record) {
            return !is_null($record) && $record->status != 0;
        };

        $query = fn(Builder $query) => $query->where('user_id', Auth::user()->id);

        return [
            $helper->select('message_id')
                ->disabled($disabled)
                ->label(__('common.message'))
                ->relationship('message', 'subject', $query),
            $helper->dateTime('when')
                ->disabled($disabled)
                ->label(__('common.when'))
                ->default($now->minute(15))
                ->minDate($now),
            $helper->checkbox('receivers')
                ->disabled($disabled)
                ->label(__('common.receivers'))
                ->relationship(titleAttribute: 'email', modifyQueryUsing: $query)
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

    public static function info(): array
    {
        $helper = filamentInfoHelper();

        return [
            $helper->textEntry('status')
                ->formatStateUsing(fn($state) => Status::from($state)->t())
                ->badge()
                ->color(fn(int $state): string => match ($state) {
                    1 => 'warning',
                    2 => 'success',
                    3, 4 => 'danger',
                    default => 'gray'
                }),
            $helper->textEntry('when')
                ->label(__('common.when'))
                ->badge()
                ->color('success'),
            $helper->textEntry('created_at')
                ->label(__('common.created_at'))
                ->badge()
                ->color('gray'),
            $helper->textEntry('updated_at')
                ->label(__('common.updated_at'))
                ->badge()
                ->color('success'),
            $helper->textEntry('user.name')
                ->label(__('common.owner'))
                ->columnSpanFull(),
            $helper->textEntry('message.subject')
                ->label(__('common.subject'))
                ->columnSpanFull(),
            $helper->textEntry('message.message.text')
                ->label(__('common.text'))
                ->columnSpanFull(),
            $helper->textEntry('message.message.html')
                ->html()
                ->label('HTML')
                ->columnSpanFull(),
        ];
    }
}
