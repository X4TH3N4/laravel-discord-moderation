<?php

namespace App\Filament\Home\Widgets;

use App\Models\Category;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CategoryChart extends ChartWidget
{
//    protected static ?string $heading = 'Eser Grafiği';

    public function getHeading(): Stat
    {
        return Stat::make('Kategoriler', Category::count());
    }

    protected static string $color = 'info';

    protected function getData(): array
    {
        $data = Trend::model(Category::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Kategoriler',
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
