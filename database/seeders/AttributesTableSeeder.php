<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attributes')->insert([
            // Laptop attributes
            ['name' => 'RAM',        'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HDD Size',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Screen Size', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CPU',        'created_at' => now(), 'updated_at' => now()],
            // Keyboard attributes
            ['name' => 'Type',         'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Connectivity', 'created_at' => now(), 'updated_at' => now()],
            // Screen attribute (resolution)
            ['name' => 'Resolution', 'created_at' => now(), 'updated_at' => now()],
            // Mouse attributes
            ['name' => 'DPI',        'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Type',       'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
