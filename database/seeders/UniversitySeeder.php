<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        University::factory()->create([
            'university_id' => 1,
            'university_code' => 'UIT',
            'name' => 'University Ibn Tofail'
        ]);
    }
}
