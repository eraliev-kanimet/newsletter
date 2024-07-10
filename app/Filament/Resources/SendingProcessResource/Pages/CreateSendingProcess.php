<?php

namespace App\Filament\Resources\SendingProcessResource\Pages;

use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Filament\Resources\SendingProcessResource;
use App\Models\Message;
use App\Models\SendingProcess;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateSendingProcess extends CreateRecord
{
    protected static string $resource = SendingProcessResource::class;

    public Model|SendingProcess|null $record;

    public bool $run_now = false;

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

        $this->run_now = $data['run_now'];

        if ($data['run_now']) {
            $data['when'] = now();
        }

        return $data;
    }

    public function afterCreate(): void
    {
        if ($this->run_now) {
            /** @var SendingProcessServiceInterface $service */
            $service = app(SendingProcessServiceInterface::class);

            $service->set($this->record);

            $service->sendToMail();

            $service->completed();

            $this->record = $service->get();
        }
    }
}
