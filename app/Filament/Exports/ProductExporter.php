<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Nama Produk'),
            ExportColumn::make('category.name')
                ->label('Kategori'),
            ExportColumn::make('stock')
                ->label('Stok'),
            ExportColumn::make('purchase_price')
                ->label('Harga Beli')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ExportColumn::make('selling_price')
                ->label('Harga Jual')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ExportColumn::make('created_at')
                ->label('Tanggal Dibuat'),
            ExportColumn::make('updated_at')
                ->label('Tanggal Diupdate'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export produk telah selesai dan ' . number_format($export->successful_rows) . ' ' . str('baris')->plural($export->successful_rows) . ' berhasil diexport.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('baris')->plural($failedRowsCount) . ' gagal diexport.';
        }

        return $body;
    }
}