<?php

namespace App\Filament\Resources\SendingProcessResource\Pages;

use App\Enums\SendingProcessStatus as Status;
use App\Filament\Resources\SendingProcessResource;
use App\Filament\Resources\SendingProcessResource\Schemas\SendingProcessResourceInfo;
use App\Models\SendingProcess;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ListSendingProcesses extends ListRecords
{
    protected static string $resource = SendingProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();

        $restart = [
            Status::completed->value,
            Status::failed->value,
            Status::cancelled->value,
        ];

        $pending = Status::pending->value;

        return $table
            ->selectable()
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
                    ->formatStateUsing(fn($state) => Status::from($state)->t())
                    ->badge()
                    ->color(fn(int $state): string => match ($state) {
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
                $helper->deleted(),
            ])
            ->actions([
                $helper->editAction()
                    ->hidden(fn(SendingProcess $record) => $record->status != $pending),
                $helper->viewAction()
                    ->hidden(fn(SendingProcess $record) => $record->status == $pending),
                $helper->actionGroup([
                    $helper->deleteAction(),
                    $helper->restoreAction(),
                    $helper->forceDeleteAction(),
                    $helper->action('cancelAction')
                        ->label(__('common.cancel'))
                        ->color('danger')
                        ->icon('heroicon-o-x-mark')
                        ->hidden(fn(SendingProcess $record) => $record->status != $pending || $record->trashed())
                        ->action($this->changeStatusAction(Status::cancelled, [$pending])),
                    $helper->action('restartAction')
                        ->label(__('common.restart'))
                        ->color('success')
                        ->icon('heroicon-o-arrow-path')
                        ->hidden(fn(SendingProcess $record) => !in_array($record->status, $restart) || $record->trashed())
                        ->action($this->changeStatusAction(Status::pending, $restart)),
                ])
            ])
            ->bulkActions([
                $helper->deleteBulkAction(),
                $helper->bulkAction('restart')
                    ->label(__('common.restart'))
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $selectedRecords) use ($restart) {
                        $selectedRecords = $selectedRecords->whereIn('status', $restart);

                        if ($selectedRecords->isNotEmpty()) {
                            $selectedRecords
                                ->toQuery()
                                ->update(['status' => Status::pending->value]);
                        }
                    }),
                $helper->bulkAction('cancel')
                    ->label(__('common.cancel'))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $selectedRecords) {
                        $selectedRecords = $selectedRecords->where('status', Status::pending->value);

                        if ($selectedRecords->isNotEmpty()) {
                            $selectedRecords
                                ->toQuery()
                                ->update(['status' => Status::cancelled->value]);
                        }
                    }),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(SendingProcessResourceInfo::info());
    }

    public function changeStatusAction(Status $status, array $array): callable
    {
        return function (SendingProcess $record) use ($status, $array) {
            if (in_array($record->status, $array)) {
                $record->update([
                    'status' => $status->value,
                ]);
            }
        };
    }
}
