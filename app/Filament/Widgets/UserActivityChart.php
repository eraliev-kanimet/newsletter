<?php

namespace App\Filament\Widgets;

use App\Contracts\User\UserActivityChartServiceInterface;
use App\Filament\Traits\ChartWidgetTrait;
use Filament\Widgets\ChartWidget;

class UserActivityChart extends ChartWidget
{
    use ChartWidgetTrait;

    public ?string $filter = 'year';

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
}
