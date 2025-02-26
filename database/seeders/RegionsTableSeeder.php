<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['name' => 'Singapore', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Malaysia',  'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
