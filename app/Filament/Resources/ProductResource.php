<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\Widgets\ProductStockPieChart;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\ProductExporter;
use App\Models\StockIn;
use App\Models\StockOut;
use Filament\Actions\Exports\Enums\ExportFormat;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                TextInput::make('purchase_price')
                    ->label('Purchase Price per Unit')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0),
                TextInput::make('selling_price')
                    ->label('Selling Price per Unit')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('stock')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('purchase_price')
                    ->label('Purchase Price per Unit')
                    ->prefix('Rp. ')
                    ->formatStateUsing(fn (string $state): string => number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->label('Selling Price per Unit')
                    ->prefix('Rp. ')
                    ->formatStateUsing(fn (string $state): string => number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn ($action, $record) => Auth::user()?->role === 'admin'),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($action, $record) => Auth::user()?->role === 'admin')
                    ->before(function ($record) {
                    }),
            ])
            ->bulkActions(
                Auth::user()?->role === 'admin'
                    ? [
                        Tables\Actions\BulkActionGroup::make([
                            Tables\Actions\DeleteBulkAction::make()
                        ])->label('Manage')
                    ]
                    : []
            )
            ->headerActions([
                ExportAction::make()
                ->label('Export')
                ->exporter(ProductExporter::class)
                ->formats([
                    ExportFormat::Xlsx
                ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->role === 'admin';
    }
}
