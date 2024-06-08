<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Resources\ReceiverResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReceiver extends EditRecord
{
    protected static string $resource = ReceiverResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return ReceiverResource\ReceiverResourceForm::sanitizing($data);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
