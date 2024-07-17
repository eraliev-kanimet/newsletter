<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;

trait ChartWidgetTrait
{
    protected function getFilters(): ?array
    {
        return [
            'today' => __('common.today'),
            'week' => __('common.last_week'),
            'month' => __('common.last_month'),
            'year' => __('common.this_year'),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }

    public static function canView(): bool
    {
        return Auth::user()->isRole();
    }
}
