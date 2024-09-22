<?php

namespace App\Filament\Home\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserChart extends ChartWidget
{
//    protected static ?string $heading = 'Eser Grafiği';

    public function getHeading(): Stat
    {
        return Stat::make('Kullanıcılar', User::count());
    }

    protected static string $color = 'info';

    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Kullanıcılar',
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
