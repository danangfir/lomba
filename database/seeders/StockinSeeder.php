<?php
namespace Database\Seeders;

use App\Models\Stockin;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockinSeeder extends Seeder
{
    public function run(): void
    {
        $stockins = [
            [
                'name' => 'Initial Stock Smartphone',
                'stock' => 50,
                'product_id' => 1,
                'created_at' => '2024-01-20 09:00:00',
                'updated_at' => '2024-01-20 09:00:00'
            ],
            [
                'name' => 'Initial Stock T-Shirt',
                'stock' => 100,
                'product_id' => 2,
                'created_at' => '2024-01-21 10:30:00',
                'updated_at' => '2024-01-21 10:30:00'
            ],
            [
                'name' => 'Initial Stock Noodles',
                'stock' => 200,
                'product_id' => 3,
                'created_at' => '2024-01-22 13:15:00',
                'updated_at' => '2024-01-22 13:15:00'
            ],
            [
                'name' => 'Initial Stock Face Cream',
                'stock' => 30,
                'product_id' => 4,
                'created_at' => '2024-01-23 14:45:00',
                'updated_at' => '2024-01-23 14:45:00'
            ],
            [
                'name' => 'Initial Stock Bedsheet',
                'stock' => 25,
                'product_id' => 5,
                'created_at' => '2024-01-24 15:20:00',
                'updated_at' => '2024-01-24 15:20:00'
            ],
        ];

        foreach ($stockins as $stockin) {
            Stockin::create($stockin);
        }
    }
}