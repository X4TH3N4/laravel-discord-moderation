<?php

namespace App\Filament\Home\Widgets;

use App\Models\Request;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class RequestChart extends ChartWidget
{
//    protected static ?string $heading = 'Eser Grafiği';

    public function getHeading(): Stat
    {
        return Stat::make('İstekler', Request::count());
    }

    protected static string $color = 'info';

    protected function getData(): array
    {
        $data = Trend::model(Request::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Talepler',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),

        ];
    }
    protected function getType(): string
    {
        return 'line';
    }
}
