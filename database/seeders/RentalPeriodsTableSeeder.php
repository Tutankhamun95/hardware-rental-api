<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rental_periods')->insert([
            ['duration' => 3,  'label' => '3 months',  'created_at' => now(), 'updated_at' => now()],
            ['duration' => 6,  'label' => '6 months',  'created_at' => now(), 'updated_at' => now()],
            ['duration' => 12, 'label' => '12 months', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
