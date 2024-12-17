<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Stockin;
use App\Models\StockOut;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\StockoutExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Resources\StockoutResource\Pages;

class StockoutResource extends Resource
{
    protected static ?string $model = StockOut::class;
    protected static ?string $navigationGroup = 'Stock Movements';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('product.category.name')
                    ->label('Category Name')
                    ->searchable(),
                TextColumn::make('stock')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])->label('Manage'),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export')
                    ->exporter(StockoutExporter::class)
                    ->formats([
                        ExportFormat::Xlsx,
                    ]),
                ]);
    }

    public static function getRelations(): array
    {
        return [
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockouts::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
