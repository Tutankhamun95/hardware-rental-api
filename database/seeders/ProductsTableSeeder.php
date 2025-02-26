<?php
// database/seeders/ProductsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [1, 2, 3, 4]; // Laptop, Keyboard, Screen, Mouse

        for ($i = 1; $i <= 30; $i++) {
            DB::table('products')->insert([
                'name' => "Product $i",
                'description' => "Description for Product $i",
                'sku' => "SKU-$i",
                'category_id' => $categories[array_rand($categories)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
