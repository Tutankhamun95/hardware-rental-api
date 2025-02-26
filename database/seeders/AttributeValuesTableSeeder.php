<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dell XPS 15 (Product ID: 1)
        DB::table('attribute_values')->insert([
            [
                'product_id'   => 1,
                'attribute_id' => 1, // RAM
                'value'        => '16GB',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'product_id'   => 1,
                'attribute_id' => 2, // HDD Size
                'value'        => '512GB SSD',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'product_id'   => 1,
                'attribute_id' => 3, // Screen Size
                'value'        => '15-inch',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'product_id'   => 1,
                'attribute_id' => 4, // CPU
                'value'        => 'Intel Core i7',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        // Logitech Mechanical Keyboard (Product ID: 2)
        DB::table('attribute_values')->insert([
            [
                'product_id'   => 2,
                'attribute_id' => 5, // Type (Keyboard)
                'value'        => 'Mechanical',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'product_id'   => 2,
                'attribute_id' => 6, // Connectivity
                'value'        => 'Wired',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        // Samsung 27" Monitor (Product ID: 3)
        DB::table('attribute_values')->insert([
            [
                'product_id'   => 3,
                'attribute_id' => 3, // Screen Size reused (or you may use a dedicated attribute)
                'value'        => '27-inch',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'product_id'   => 3,
                'attribute_id' => 7, // Resolution
                'value'        => '4K',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        // Logitech Wireless Mouse (Product ID: 4)
        DB::table('attribute_values')->insert([
            [
                'product_id'   => 4,
                'attribute_id' => 8, // DPI
                'value'        => '1600 DPI',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'product_id'   => 4,
                'attribute_id' => 9, // Type (Mouse)
                'value'        => 'Wireless',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
