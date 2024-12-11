<?php

namespace App\Filament\Resources\StockoutResource\Pages;

use App\Filament\Resources\StockoutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockouts extends ListRecords
{
    protected static string $resource = StockoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
