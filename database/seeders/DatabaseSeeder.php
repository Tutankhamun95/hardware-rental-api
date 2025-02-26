<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionsTableSeeder::class,
            RentalPeriodsTableSeeder::class,
            CategoriesTableSeeder::class,
            AttributesTableSeeder::class,
            ProductsTableSeeder::class,
            AttributeValuesTableSeeder::class,
            ProductPricingTableSeeder::class,
            InventoryTableSeeder::class,
        ]);
    }
}
