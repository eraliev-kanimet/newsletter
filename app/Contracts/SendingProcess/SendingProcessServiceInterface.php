<?php

namespace App\Contracts\SendingProcess;

use App\Models\SendingProcess;

interface SendingProcessServiceInterface
{
    public function get(): SendingProcess;

    public function set(SendingProcess $process): static;

    public function sendToMail(): static;

    public function completed(): static;
}
