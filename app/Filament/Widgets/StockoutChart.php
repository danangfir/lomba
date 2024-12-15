<?php

namespace App\Filament\Widgets;

use App\Models\Stockout;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StockoutChart extends ChartWidget
{
    protected static ?string $heading = 'Stockout Trend';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $stockouts = Stockout::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(stock) as total_stock')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return [
            'labels' => $stockouts->pluck('date')->toArray(),
            'datasets' => [
                [
                    'label' => 'Daily Stockouts',
                    'data' => $stockouts->pluck('total_stock')->toArray(),
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1,
                    'borderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                    'pointBackgroundColor' => 'rgb(75, 192, 192)',
                    'pointHoverBackgroundColor' => 'rgb(75, 192, 192)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBorderColor' => '#fff',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 12,
                        'fontColor' => '#333',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'drawBorder' => false,
                    ],
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}