<?php

namespace App\Enums;

enum SendingProcessStatus: int
{
    case pending = 0;
    case in_progress = 1;
    case completed = 2;
    case failed = 3;
    case cancelled = 4;

    public function t(): string
    {
        return __('common.' . $this->name);
    }
}

