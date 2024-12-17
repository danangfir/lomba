<?php

namespace App\Filament\Exports;

use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\ExportColumn;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StockoutExporter extends Exporter
{
    /**
     * Tentukan nama file default untuk hasil export.
     *
     * @return string
     */
    public function getDefaultFilename(): string
    {
        return 'stockout-export-' . now()->format('Y-m-d_H-i-s') . '.xlsx';
    }

    /**
     * Ambil query records yang akan di-export.
     *
     * @return Builder
     */
    protected function getRecords(): Builder
    {
        return \App\Models\Stockout::query()->with('product.category');
    }

    /**
     * Proses export menggunakan Maatwebsite Excel.
     *
     * @return StreamedResponse
     */
    public function export(): Response
    {
        return Excel::download(
            new StockoutExportFromQuery($this->getRecords()),
            $this->getDefaultFilename()
        );
    }

    /**
     * Tentukan kolom yang akan diexport menggunakan ExportColumn.
     *
     * @return array
     */
    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('name')->label('Name'),
            ExportColumn::make('product.category.name')->label('Category Name'),
            ExportColumn::make('stock')->label('Stock'),
            ExportColumn::make('created_at')->label('Created At'),
        ];
    }

    /**
     * Tentukan notifikasi setelah export selesai.
     *
     * @param Export $export
     * @return string
     */
    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'The Stockout export has been completed successfully!';
    }
}
