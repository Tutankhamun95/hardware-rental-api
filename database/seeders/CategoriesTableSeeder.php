<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Laptop',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Keyboard', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Screen',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mouse',    'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
