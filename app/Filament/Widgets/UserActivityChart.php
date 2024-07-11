<?php

namespace App\Filament\Widgets;

use App\Contracts\User\UserActivityChartServiceInterface;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class UserActivityChart extends ChartWidget
{
    public ?string $filter = 'today';

    protected int|string|array $columnSpan = 2;

    protected static ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'line';
    }

    public function getHeading(): ?string
    {
        return __('admin.user_activity');
    }

    protected function getData(): array
    {
        /** @var UserActivityChartServiceInterface $service */
        $service = app(UserActivityChartServiceInterface::class);

        $service->setFilter($this->filter);

        return [
            'datasets' => [
                [
                    'data' => $service->get(),
                ],
            ],
        ];
    }

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
