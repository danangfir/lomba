<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'created_at' => '2024-12-01 09:00:00',
                'updated_at' => '2024-12-01 09:00:00'
            ],
            [
                'name' => 'Fashion',
                'created_at' => '2024-12-01 09:15:00',
                'updated_at' => '2024-12-01 09:15:00'
            ],
            [
                'name' => 'Food & Beverage',
                'created_at' => '2024-12-01 09:30:00',
                'updated_at' => '2024-12-01 09:30:00'
            ],
            [
                'name' => 'Health & Beauty',
                'created_at' => '2024-12-01 09:45:00',
                'updated_at' => '2024-12-01 09:45:00'
            ],
            [
                'name' => 'Home & Living',
                'created_at' => '2024-12-01 10:00:00',
                'updated_at' => '2024-12-01 10:00:00'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}