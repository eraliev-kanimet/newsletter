<?php

namespace App\Traits\Models;

trait UserTrait
{
    public function isRole(int $role = 1): bool
    {
        return in_array($role, $this->roles);
    }
}
