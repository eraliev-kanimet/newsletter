<?php

namespace App\Services\Models\SendingProcess;

use App\Contracts\SendingProcess\UpdateSendingProcessServiceInterface;
use App\Models\SendingProcess;
use App\Traits\Services\SendingProcess\SendingProcessServiceTrait;

class UpdateSendingProcessService implements UpdateSendingProcessServiceInterface
{
    use SendingProcessServiceTrait;

    protected SendingProcess $process;

    public function execute(array $data): void
    {
        $this->process->update($data);

        if (isset($data['attach_receivers'])) {
            $this->process->receivers()->syncWithoutDetaching($data['attach_receivers']);
        }

        if (isset($data['detach_receivers'])) {
            $this->process->receivers()->detach($data['detach_receivers']);
        }
    }
}
