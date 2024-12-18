<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockinResource\Pages;
use App\Models\Stockin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\StockinExporter;
use Filament\Actions\Exports\Enums\ExportFormat;

class StockinResource extends Resource
{
    protected static ?string $model = Stockin::class;
    protected static ?string $navigationGroup = 'Stock Movements';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Stock In';
    protected static ?string $pluralModelLabel = 'Stock In';

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
                TextColumn::make('unit_price')
                    ->prefix('Rp ')
                    ->formatStateUsing(fn (string $state): string => number_format($state, 0, ',', '.'))
                    ->label('Unit Price')
                    ->sortable(),
                TextColumn::make('total_price')
                    ->prefix('Rp ')
                    ->formatStateUsing(fn (string $state): string => number_format($state, 0, ',', '.'))
                    ->label('Total Price')
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
                    ->exporter(StockinExporter::class)
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
            'index' => Pages\ListStockins::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
