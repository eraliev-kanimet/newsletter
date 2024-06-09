<?php

namespace App\Filament\Resources\SendingProcessResource\Schemas;

use App\Enums\SendingProcessStatus as Status;

class SendingProcessResourceInfo
{
    public static function info(): array
    {
        $helper = filamentInfoHelper();

        return [
            $helper->textEntry('status')
                ->label(__('common.status'))
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
            $helper->textEntry('message.text')
                ->label(__('common.text'))
                ->columnSpanFull(),
            $helper->textEntry('message.html')
                ->html()
                ->label('HTML')
                ->columnSpanFull(),
            $helper->repeatableEntry('receivers')
                ->schema([
                    $helper->textEntry('email')
                ])
                ->columnSpanFull()
                ->grid()
        ];
    }
}
