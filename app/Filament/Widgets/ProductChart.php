<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductChart extends ChartWidget
{
    protected static ?string $heading = 'Product Chart';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $products = Product::all();

        $productNames = $products->pluck('name')->toArray();
        $productStocks = $products->pluck('stock')->toArray();

        $colors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(199, 199, 199, 0.7)',
            'rgba(83, 102, 255, 0.7)',
            'rgba(255, 99, 255, 0.7)',
            'rgba(99, 255, 132, 0.7)',
        ];

        $productColors = array_map(function($index) use ($colors) {
            return $colors[$index % count($colors)];
        }, array_keys($productNames));

        return [
            'labels' => $productNames,
            'datasets' => [
                [
                    'label' => 'Product Stock',
                    'data' => $productStocks,
                    'backgroundColor' => $productColors,
                    'borderWidth' => 2,
                    'hoverOffset' => 10,
                ],
            ],
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
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
            'cutout' => '50%',
            'responsive' => true,
        ];
    }
}