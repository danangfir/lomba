<?php

namespace Database\Seeders;

use App\Models\Stockout;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockoutSeeder extends Seeder
{
    public function run(): void
    {
        $stockouts = [
            [
                'name' => 'Sales Smartphone',
                'stock' => 5,
                'product_id' => 1,
                'created_at' => '2024-01-20 13:20:00',
                'updated_at' => '2024-01-20 13:20:00'
            ],
            [
                'name' => 'Sales T-Shirt',
                'stock' => 10,
                'product_id' => 2,
                'created_at' => '2024-01-21 14:30:00',
                'updated_at' => '2024-01-21 14:30:00'
            ],
            [
                'name' => 'Sales Noodles',
                'stock' => 50,
                'product_id' => 3,
                'created_at' => '2024-01-22 09:15:00',
                'updated_at' => '2024-01-22 09:15:00'
            ],
            [
                'name' => 'Sales Face Cream',
                'stock' => 5,
                'product_id' => 4,
                'created_at' => '2024-01-23 11:45:00',
                'updated_at' => '2024-01-23 11:45:00'
            ],
            [
                'name' => 'Sales Bedsheet',
                'stock' => 3,
                'product_id' => 5,
                'created_at' => '2024-01-24 16:00:00',
                'updated_at' => '2024-01-24 16:00:00'
            ],
        ];

        foreach ($stockouts as $stockout) {
            Stockout::create($stockout);
        }
    }
}