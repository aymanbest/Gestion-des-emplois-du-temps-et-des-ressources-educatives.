<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Year::factory()->create([
            'year_id' => 1,
            'year' => '2023'
        ]);

        Year::factory()->create([
            'year_id' => 2,
            'year' => '2024'
        ]);
    }
}
