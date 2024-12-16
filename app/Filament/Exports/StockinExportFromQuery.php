<?php

namespace App\Filament\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockinExportFromQuery implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected Builder $query;

    /**
     * Konstruktor untuk menyimpan query builder.
     *
     * @param Builder $query
     */
    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * Tentukan query untuk data yang akan di-export.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->query;
    }

    /**
     * Definisikan header kolom untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category Name',
            'Stock',
            'Created At',
        ];
    }

    /**
     * Mapping data ke format baris Excel.
     *
     * @param object $stockin
     * @return array
     */
    public function map($stockin): array
    {
        return [
            $stockin->id,
            $stockin->name,
            optional($stockin->product->category)->name, 
            $stockin->stock,
            $stockin->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
