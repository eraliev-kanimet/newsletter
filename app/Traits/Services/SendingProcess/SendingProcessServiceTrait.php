<?php

namespace App\Traits\Services\SendingProcess;

use App\Models\SendingProcess;

/**
 * @property SendingProcess $process
 */
trait SendingProcessServiceTrait
{
    public function get(): SendingProcess
    {
        return $this->process;
    }

    public function set(SendingProcess $process): static
    {
        $this->process = $process;

        return $this;
    }
}
