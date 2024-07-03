<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

function filamentRoleFiltering(Builder $query): Builder
{
    $user = Auth::user();

    if ($user->isRole()) {
        return $query;
    }

    return $query->where('user_id', $user->id);
}
