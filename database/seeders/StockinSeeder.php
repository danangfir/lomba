<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stockin;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockinSeeder extends Seeder
{
    public function run(): void
    {
        $stockins = [
            [
                'name' => 'Samsung',
                'stock' => 50,
                'product_id' => 1,
                'created_at' => '2024-12-02 13:00:00',
                'updated_at' => '2024-12-02 13:00:00'
            ],
            [
                'name' => 'T-Shirt Premium',
                'stock' => 100,
                'product_id' => 2,
                'created_at' => '2024-12-03 14:15:00',
                'updated_at' => '2024-12-03 14:15:00'
            ],
            [
                'name' => 'Instant Noodles',
                'stock' => 200,
                'product_id' => 3,
                'created_at' => '2024-12-04 10:30:00',
                'updated_at' => '2024-12-04 10:30:00'
            ],
            [
                'name' => 'Face Cream',
                'stock' => 30,
                'product_id' => 4,
                'created_at' => '2024-12-05 09:45:00',
                'updated_at' => '2024-12-05 09:45:00'
            ],
            [
                'name' => 'Bedsheet set',
                'stock' => 25,
                'product_id' => 5,
                'created_at' => '2024-12-06 11:20:00',
                'updated_at' => '2024-12-06 11:20:00'
            ],
        ];

        foreach ($stockins as $stockin) {
            $product = Product::find($stockin['product_id']);
            if ($product) {
                $stockin['unit_price'] = $product->purchase_price;
                $stockin['total_price'] = $product->purchase_price * $stockin['stock'];
                Stockin::create($stockin);
            }
        }
    }
}