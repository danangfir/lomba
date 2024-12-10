<?php

namespace App\Filament\Resources\StockinResource\Pages;

use App\Filament\Resources\StockinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockins extends ListRecords
{
    protected static string $resource = StockinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
