<?php

namespace App\Services\Abstract;

use App\Contracts\Abstract\ActivityChartInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

abstract class ActivityChartService implements ActivityChartInterface
{
    protected mixed $afterQuery = null;

    protected string $filter = 'year';
    protected string $column = 'DATA';

    abstract protected function query(): Builder;

    protected function filter(): Builder
    {
        $raw = match ($this->filter) {
            'year' => 'MONTH(created_at)',
            'month' => 'DAY(created_at)',
            'week' => 'DAYOFWEEK(created_at)',
            default => 'HOUR(created_at)'
        };

        $query = $this->query()->select(DB::raw("COUNT(*) as count, $raw as $this->column"));

        switch ($this->filter) {
            case 'year':
                $query->whereYear('created_at', date('Y'));
                break;
            case 'week':
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();

                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                break;
            case 'month':
                $query->whereMonth('created_at', date('m'));
                break;
            default:
                $query
                    ->whereDay('created_at', date('d'))
                    ->whereMonth('created_at', date('m'));
                break;
        }

        $query
            ->groupBy($this->column)
            ->orderBy($this->column);

        if (is_callable($this->afterQuery)) {
            return call_user_func($this->afterQuery, $query);
        }

        return $query;
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

    public function setFilter(string $filter): static
    {
        $this->filter = $filter;

        return $this;
    }

    public function get(): array
    {
        return $this->format(
            $this->filter()
                ->pluck('count', $this->column)
                ->toArray()
        );
    }

    public function setAfterQuery(callable $callback): void
    {
        $this->afterQuery = $callback;
    }
}
