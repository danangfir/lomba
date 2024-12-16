<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockoutResource\Pages;
use App\Filament\Resources\StockoutResource\RelationManagers;
use App\Models\Stockout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockoutResource extends Resource
{
    protected static ?string $model = Stockout::class;
    protected static ?string $navigationGroup = 'Stock Movements';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

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
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product.category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('stock')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
