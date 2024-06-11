<?php

namespace App\Filament\Resources\SendingProcessResource\Pages;

use App\Enums\SendingProcessStatus as Status;
use App\Filament\Resources\SendingProcessResource;
use App\Filament\Resources\SendingProcessResource\Schemas\SendingProcessResourceInfo;
use App\Helpers\Filament\FilamentTableHelper;
use App\Models\SendingProcess;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['user', 'receivers']))
            ->poll('30s')
            ->columns([
                $helper->text('user.name')
                    ->label(__('common.author')),
                $helper->text('message.subject')
                    ->searchable()
                    ->label(__('common.message')),
                $helper->text('when')
                    ->alignCenter()
                    ->sortable()
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
                    ->sortable()
                    ->label(__('common.receivers')),
                $helper->deleted(),
                $helper->created()
                    ->sortable(),
                $helper->updated()
                    ->sortable(),
            ])
            ->filters([
                $helper->selectFilter('status')
                    ->label(__('common.status'))
                    ->options(Status::options()),
                $helper->authorSelectFilter('user'),
                $helper->trashedFilter(),
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
                    $this->customAction('cancel', $helper, Status::cancelled, [$pending])
                        ->color('danger')
                        ->icon('heroicon-o-x-mark')
                        ->hidden(fn(SendingProcess $record) => $record->status != $pending || $record->trashed()),
                    $this->customAction('restart', $helper, Status::pending, $restart)
                        ->color('success')
                        ->icon('heroicon-o-arrow-path')
                        ->hidden(fn(SendingProcess $record) => !in_array($record->status, $restart) || $record->trashed()),
                ])
            ])
            ->bulkActions([
                $helper->deleteBulkAction(),
                $this->customBulkAction('restart', $helper, Status::pending->value, $restart)
                    ->icon('heroicon-o-arrow-path')
                    ->color('success'),
                $this->customBulkAction('cancel', $helper, Status::cancelled->value, [Status::pending->value])
                    ->icon('heroicon-o-x-mark')
                    ->color('danger'),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(SendingProcessResourceInfo::info());
    }

    public function customAction(string $name, FilamentTableHelper $helper, Status $status, array $statuses): Action
    {
        return $helper->action("{$name}Action")
            ->label(__("common.$name"))
            ->action(function (SendingProcess $record) use ($status, $statuses) {
                if (in_array($record->status, $statuses)) {
                    $record->update([
                        'status' => $status->value,
                    ]);
                }
            });
    }

    public function customBulkAction(string $name, FilamentTableHelper $helper, int $status, array $statuses): BulkAction
    {
        return $helper->bulkAction($name)
            ->label(__("common.$name"))
            ->requiresConfirmation()
            ->deselectRecordsAfterCompletion()
            ->action(function (Collection $selectedRecords) use ($status, $statuses) {
                $selectedRecords = $selectedRecords->whereIn('status', $statuses);

                if ($selectedRecords->isNotEmpty()) {
                    $selectedRecords
                        ->toQuery()
                        ->update(['status' => $status]);
                }
            });
    }
}
