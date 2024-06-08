<?php

namespace App\Filament\Resources\SendingProcessResource\Pages;

use App\Enums\SendingProcessStatus as Status;
use App\Filament\Resources\SendingProcessResource;
use App\Filament\Resources\SendingProcessResource\SendingProcessResourceForm;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListSendingProcesses extends ListRecords
{
    protected static string $resource = SendingProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(SendingProcessResourceForm::modifyBeforeCreate()),
        ];
    }

    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();

        return $table
            ->columns([
                $helper->text('user.name')
                    ->label(__('common.owner')),
                $helper->text('message.subject')
                    ->label(__('common.message')),
                $helper->text('when')
                    ->alignCenter()
                    ->label(__('common.when')),
                $helper->text('status')
                    ->alignCenter()
                    ->formatStateUsing(fn ($state) => Status::from($state)->t())
                    ->badge()
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'warning',
                        2 => 'success',
                        3, 4 => 'danger',
                        default => 'gray'
                    })
                    ->label(__('common.status')),
                $helper->text('receivers_count')
                    ->counts('receivers')
                    ->alignCenter()
                    ->label(__('common.receivers')),
            ])
            ->actions([])
            ->bulkActions([
                $helper->deleteBulkAction(),
            ]);
    }
}
