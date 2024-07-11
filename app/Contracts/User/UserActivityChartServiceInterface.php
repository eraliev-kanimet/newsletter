<?php

namespace App\Contracts\User;

interface UserActivityChartServiceInterface
{
    public function setFilter(string $filter): static;

    public function get(): array;
}
