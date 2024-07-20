<?php

namespace App\Services\Models\SendingProcess;

use App\Contracts\SendingProcess\CreateSendingProcessServiceInterface;
use App\Contracts\SendingProcess\SendingProcessServiceInterface;
use App\Models\SendingProcess;

class CreateSendingProcessService implements CreateSendingProcessServiceInterface
{
    public function execute(array $data, bool $run_now = false): SendingProcessServiceInterface
    {
        if ($run_now) {
            $data['when'] = now();
        }

        $process = SendingProcess::create($data);

        $process->receivers()->sync($data['receivers']);

        /** @var SendingProcessServiceInterface $service */
        $service = app(SendingProcessServiceInterface::class);

        $service->set($process->fresh());

        if ($run_now) {
            $service->sendToMail()->completed();
        }

        return $service;
    }
}
