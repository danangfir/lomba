<?php

namespace App\Filament\Widgets;

use App\Models\StockIn;
use App\Models\Stockout;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StockCorrelationChart extends ChartWidget
{
    protected static ?string $heading = 'Stock Movement Correlation';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $stockData = DB::table(function ($query) {
            $query->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('"stock_in" as type')
            )
            ->from('stockin')
            ->groupBy('date');
        }, 'a')
        ->unionAll(function ($query) {
            $query->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('"stock_out" as type')
            )
            ->from('stockout')
            ->groupBy('date');
        })
        ->get()
        ->groupBy('date');

        $dates = [];
        $stockInData = [];
        $stockOutData = [];

        foreach ($stockData as $date => $data) {
            $dates[] = $date;
            
            $stockInEntry = $data->firstWhere('type', 'stock_in');
            $stockOutEntry = $data->firstWhere('type', 'stock_out');
            
            $stockInData[] = $stockInEntry ? $stockInEntry->total_stock : 0;
            $stockOutData[] = $stockOutEntry ? $stockOutEntry->total_stock : 0;
        }

        return [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Stock In',
                    'data' => $stockInData,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'fill' => true,
                    'tension' => 0.1,
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Stock Out',
                    'data' => $stockOutData,
                    'borderColor' => 'rgb(255, 99, 132)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'fill' => true,
                    'tension' => 0.1,
                    'borderWidth' => 2,
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
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
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