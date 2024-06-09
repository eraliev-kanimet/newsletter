<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Resources\ReceiverResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateReceiver extends CreateRecord
{
    protected static string $resource = ReceiverResource::class;

    public function getTitle(): string
    {
        return __('common.create_receiver');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;

        return ReceiverResource\ReceiverResourceForm::sanitizing($data);
    }
}
