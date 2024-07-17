<?php

namespace App\Contracts\Abstract;

interface ActivityChartInterface
{
    public function setFilter(string $filter): static;

    public function get(): array;

    public function setAfterQuery(callable $callback): void;
}
