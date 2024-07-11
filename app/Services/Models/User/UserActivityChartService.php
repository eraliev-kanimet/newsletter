<?php

namespace App\Services\Models\User;

use App\Contracts\User\UserActivityChartServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserActivityChartService implements UserActivityChartServiceInterface
{
    protected string $filter = 'today';

    public function setFilter(string $filter): static
    {
        $this->filter = $filter;

        return $this;
    }

    public function get(): array
    {
        return $this->format(
            $this->query()
                ->pluck('count', 'DATA')
                ->toArray()
        );
    }

    protected function query(): Builder
    {
        $raw = match ($this->filter) {
            'year' => 'MONTH(created_at)',
            'month' => 'DAY(created_at)',
            'week' => 'DAYOFWEEK(created_at)',
            default => 'HOUR(created_at)'
        };

        $query = User::query();

        $query->select(DB::raw("COUNT(*) as count, $raw as DATA"));

        switch ($this->filter) {
            case 'year':
                $query->whereYear('created_at', date('Y'));
                break;
            case 'week':
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();

                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                break;
            default:
                $query->whereMonth('created_at', date('m'));
                break;
        }

        return $query
            ->groupBy('DATA')
            ->orderBy('DATA');
    }

    protected function format(array $data): array
    {
        switch ($this->filter) {
            case 'year':
                $array = [];

                $months = config('static.month.' . config('app.locale'));

                foreach ($months as $month => $label) {
                    $array[$label] = $data[$month] ?? 0;
                }

                return $array;
            case 'month':
                $array = array_fill(1, cal_days_in_current_month(), 0);

                foreach ($data as $day => $count) {
                    $array[$day] = $count;
                }

                return $array;
            case 'week':
                $array = [];

                $daysOfWeek = config('static.week.' . config('app.locale'));

                foreach ($daysOfWeek as $index => $day) {
                    $array[$day] = $data[$index] ?? 0;
                }

                return $array;
            default:
                $array = [];

                $hours = array_fill(0, 24, 0);

                foreach ($data as $hour => $count) {
                    $hours[$hour] = $count;
                }

                foreach ($hours as $hour => $count) {
                    $formattedHour = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';

                    $array[$formattedHour] = $count;
                }

                return $array;
        }
    }
}
