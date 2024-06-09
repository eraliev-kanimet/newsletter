<?php

namespace App\Filament\Resources\SendingProcessResource\Pages;

use App\Filament\Resources\SendingProcessResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditSendingProcess extends EditRecord
{
    protected static string $resource = SendingProcessResource::class;

    public function getTitle(): string
    {
        return __('common.edit_sending_process');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
