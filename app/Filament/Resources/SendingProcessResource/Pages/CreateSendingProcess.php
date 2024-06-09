<?php

namespace App\Filament\Resources\SendingProcessResource\Pages;

use App\Filament\Resources\SendingProcessResource;
use App\Models\Message;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSendingProcess extends CreateRecord
{
    protected static string $resource = SendingProcessResource::class;

    public function getTitle(): string
    {
        return __('common.create_sending_process');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;

        if (!is_null($data['message_id'])) {
            $message = Message::findOrFail($data['message_id']);

            $data['message'] = [
                'subject' => $message->subject,
                'text' => $message->data['text'] ?? '',
                'html' => $message->data['html'] ?? '',
            ];

            unset($data['message_id']);
        }

        return $data;
    }
}
