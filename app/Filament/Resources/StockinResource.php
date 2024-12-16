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
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Define form fields if necessary
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
                // Define filters if necessary
            ])
            ->actions([
<<<<<<< HEAD
                // Tables\Actions\EditAction::make(),
=======
                Tables\Actions\EditAction::make()
                    ->visible(fn ($action, $record) => Auth::user()?->role === 'admin'),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($action, $record) => Auth::user()?->role === 'admin'),
>>>>>>> develop
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
                        ExportFormat::Csv,
                    ]),
                ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relations if necessary
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
