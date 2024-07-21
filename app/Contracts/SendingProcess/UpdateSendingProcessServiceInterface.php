<?php

namespace App\Contracts\SendingProcess;

use App\Models\SendingProcess;

interface UpdateSendingProcessServiceInterface
{
    public function get(): SendingProcess;

    public function set(SendingProcess $process): static;

    public function execute(array $data);
}
