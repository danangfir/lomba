<?php

namespace App\Filament\Widgets;

use App\Models\StockIn;
use App\Models\StockOut;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class NetProfitChart extends ChartWidget
{
    protected static ?string $heading = 'Net Profit Trend';
    protected static ?int $sort = 1;
    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $stockins = StockIn::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(stock * unit_price) as total_stockin_value')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $stockouts = StockOut::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(stock * unit_price) as total_stockout_value')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $dates = $stockins->pluck('date')->merge($stockouts->pluck('date'))->unique()->sort();

        $netProfitData = $dates->map(function ($date) use ($stockins, $stockouts) {
            $stockinValue = $stockins->where('date', $date)->sum('total_stockin_value');
            $stockoutValue = $stockouts->where('date', $date)->sum('total_stockout_value');
            return $stockinValue - $stockoutValue;
        });

        return [
            'labels' => $dates->toArray(),
            'datasets' => [
                [
                    'label' => 'Net Profit',
                    'data' => $netProfitData->toArray(),
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
                        'stepSize' => 10000,
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
