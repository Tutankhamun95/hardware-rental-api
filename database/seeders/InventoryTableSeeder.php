<?php
// database/seeders/InventoryTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        $productIds = DB::table('products')->pluck('id');
        $regions = [1, 2]; // Singapore and Malaysia

        foreach ($productIds as $productId) {
            foreach ($regions as $regionId) {
                DB::table('inventory')->insert([
                    'product_id' => $productId,
                    'region_id'  => $regionId,
                    'quantity'   => rand(0, 50),
                    'status'     => (rand(0,1) ? 'available' : 'out_of_stock'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
