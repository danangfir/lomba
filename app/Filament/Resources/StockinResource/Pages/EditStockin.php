<?php

namespace App\Filament\Resources\StockinResource\Pages;

use App\Filament\Resources\StockinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockin extends EditRecord
{
    protected static string $resource = StockinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
