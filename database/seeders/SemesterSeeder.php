<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 6; $i++) {
            Semester::factory()->create([
                'semester_code' => 'SM0'. ($i+1),
                'name' => 'Semester 0'. ($i+1),
            ]);
        }
    }
}
