<?php

namespace App\Contracts\SendingProcess;

interface CreateSendingProcessServiceInterface
{
    public function execute(array $data, bool $run_now = false): SendingProcessServiceInterface;
}
