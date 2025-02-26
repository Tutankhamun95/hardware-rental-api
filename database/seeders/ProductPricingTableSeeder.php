<?php
// database/seeders/ProductPricingTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPricingTableSeeder extends Seeder
{
    public function run()
    {
        // Define several pricing patterns
        $patterns = [
            // Pattern A: Both regions, all three rental periods.
            function($productId) {
                return [
                    // Singapore pricing
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 1, 'price' => rand(100, 200)],
                    ['product_id' => $productId, 'rental_period_id' => 2, 'region_id' => 1, 'price' => rand(200, 300)],
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 1, 'price' => rand(300, 400)],
                    // Malaysia pricing
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 2, 'price' => rand(80, 150)],
                    ['product_id' => $productId, 'rental_period_id' => 2, 'region_id' => 2, 'price' => rand(150, 250)],
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 2, 'price' => rand(250, 350)],
                ];
            },
            // Pattern B: Pricing available for Malaysia only for all three periods.
            function($productId) {
                return [
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 2, 'price' => rand(80, 150)],
                    ['product_id' => $productId, 'rental_period_id' => 2, 'region_id' => 2, 'price' => rand(150, 250)],
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 2, 'price' => rand(250, 350)],
                ];
            },
            // Pattern C: Malaysia for 3,6,12 and Singapore only for 12 months.
            function($productId) {
                return [
                    // Singapore: only 12 months available
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 1, 'price' => rand(300, 400)],
                    // Malaysia: available for all three periods
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 2, 'price' => rand(80, 150)],
                    ['product_id' => $productId, 'rental_period_id' => 2, 'region_id' => 2, 'price' => rand(150, 250)],
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 2, 'price' => rand(250, 350)],
                ];
            },
            // Pattern D: Malaysia for 3 and 12 months only.
            function($productId) {
                return [
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 2, 'price' => rand(80, 150)],
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 2, 'price' => rand(250, 350)],
                ];
            },
            // Pattern E: Singapore only for 12 months.
            function($productId) {
                return [
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 1, 'price' => rand(300, 400)],
                ];
            },
            // Pattern F: Malaysia for 6 months only.
            function($productId) {
                return [
                    ['product_id' => $productId, 'rental_period_id' => 2, 'region_id' => 2, 'price' => rand(150, 250)],
                ];
            },
            // Pattern G: Singapore for 6 and 12 months only.
            function($productId) {
                return [
                    ['product_id' => $productId, 'rental_period_id' => 2, 'region_id' => 1, 'price' => rand(200, 300)],
                    ['product_id' => $productId, 'rental_period_id' => 3, 'region_id' => 1, 'price' => rand(300, 400)],
                ];
            },
            // Pattern H: Both regions, but only 3 months available.
            function($productId) {
                return [
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 1, 'price' => rand(100, 200)],
                    ['product_id' => $productId, 'rental_period_id' => 1, 'region_id' => 2, 'price' => rand(80, 150)],
                ];
            },
        ];

        // Get all product IDs
        $productIds = DB::table('products')->pluck('id');

        foreach ($productIds as $productId) {
            // Randomly choose one of the patterns
            $pattern = $patterns[array_rand($patterns)];
            $pricingEntries = $pattern($productId);

            foreach ($pricingEntries as $entry) {
                DB::table('product_pricing')->insert(array_merge($entry, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}
