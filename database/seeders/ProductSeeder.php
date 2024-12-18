<?php
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Samsung',
                'stock' => 45,
                'purchase_price' => 2000000,
                'selling_price' => 2500000,
                'category_id' => 1,
                'created_at' => '2024-12-02 13:00:00',
                'updated_at' => '2024-01-15 14:30:00'
            ],
            [
                'name' => 'T-Shirt Premium',
                'stock' => 90,
                'purchase_price' => 50000,
                'selling_price' => 75000,
                'category_id' => 2,
                'created_at' => '2024-12-03 14:15:00',
                'updated_at' => '2024-01-16 09:20:00'
            ],
            [
                'name' => 'Instant Noodles',
                'stock' => 150,
                'purchase_price' => 2500,
                'selling_price' => 3500,
                'category_id' => 3,
                'created_at' => '2024-12-04 10:30:00',
                'updated_at' => '2024-01-17 11:45:00'
            ],
            [
                'name' => 'Face Cream',
                'stock' => 25,
                'purchase_price' => 25000,
                'selling_price' => 35000,
                'category_id' => 4,
                'created_at' => '2024-12-05 09:45:00',
                'updated_at' => '2024-01-18 13:15:00'
            ],
            [
                'name' => 'Bedsheet Set',
                'stock' => 22,
                'purchase_price' => 150000,
                'selling_price' => 200000,
                'category_id' => 5,
                'created_at' => '2024-12-06 11:20:00',
                'updated_at' => '2024-01-19 15:40:00'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}