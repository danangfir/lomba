<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stockout;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockoutSeeder extends Seeder
{
    public function run(): void
    {
        $stockouts = [
            [
                'name' => 'Samsung',
                'stock' => 5,
                'product_id' => 1,
                'created_at' => '2024-12-03 13:20:00',
                'updated_at' => '2024-12-03 13:20:00'
            ],
            [
                'name' => 'T-Shirt',
                'stock' => 10,
                'product_id' => 2,
                'created_at' => '2024-12-04 14:30:00',
                'updated_at' => '2024-12-04 14:30:00'
            ],
            [
                'name' => 'Instant Noodles',
                'stock' => 50,
                'product_id' => 3,
                'created_at' => '2024-12-05 09:15:00',
                'updated_at' => '2024-12-05 09:15:00'
            ],
            [
                'name' => 'Face Cream',
                'stock' => 5,
                'product_id' => 4,
                'created_at' => '2024-12-06 11:45:00',
                'updated_at' => '2024-12-06 11:45:00'
            ],
            [
                'name' => 'Bedsheet Set',
                'stock' => 3,
                'product_id' => 5,
                'created_at' => '2024-12-07 16:00:00',
                'updated_at' => '2024-12-07 16:00:00'
            ],
        ];

        foreach ($stockouts as $stockout) {
            $product = Product::find($stockout['product_id']);
            if ($product) {
                $stockout['unit_price'] = $product->selling_price;
                $stockout['total_price'] = $product->selling_price * $stockout['stock'];
                Stockout::create($stockout);
            }
        }
    }
}