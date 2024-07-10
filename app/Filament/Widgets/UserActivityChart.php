<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UserActivityChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('admin.user_activity');
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => __('common.month'),
                    'data' => $this->getDataMonth(),
                ],
            ],
            'labels' => array_values(config('static.month.' . config('app.locale'))),
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getMaxHeight(): ?string
    {
        return '300px';
    }

    protected function getDataMonth(): array
    {
        $result = User::select(DB::raw('COUNT(*) as count, MONTH(created_at) as month'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = array_fill(1, 12, 0);

        foreach ($result as $month => $count) {
            $data[$month] = $count;
        }

        return array_values($data);
    }
}
