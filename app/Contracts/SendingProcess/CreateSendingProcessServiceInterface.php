<?php

namespace App\Contracts\SendingProcess;

interface CreateSendingProcessServiceInterface
{
    public function create(array $data, bool $run_now = false): SendingProcessServiceInterface;
}
