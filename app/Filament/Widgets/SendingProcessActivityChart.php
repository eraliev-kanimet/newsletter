<?php

namespace App\Filament\Widgets;

use App\Contracts\SendingProcess\SendingProcessActivityChartInterface;
use App\Filament\Traits\ChartWidgetTrait;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SendingProcessActivityChart extends ChartWidget
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
        return __('admin.sending_process_activity');
    }

    protected function getData(): array
    {
        /** @var SendingProcessActivityChartInterface $service */
        $service = app(SendingProcessActivityChartInterface::class);

        $service
            ->setFilter($this->filter)
            ->setAfterQuery(function (Builder $query) {
                $user = Auth::user();

                if ($user->isRole()) {
                    return $query;
                }

                return $query->where('user_id', $user->id);
            });

        return [
            'datasets' => [
                [
                    'data' => $service->get(),
                ],
            ],
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}
