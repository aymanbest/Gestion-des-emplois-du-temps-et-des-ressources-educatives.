<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= 10) {
                Section::factory()->create([
                    'section_code' => 'SEC' . ($i),
                    'name' => 'Section ' . ($i)
                ]);
            } else if ($i <= 9) {
                Section::factory()->create([
                    'section_code' => 'SEC0' . ($i),
                    'name' => 'Section 0' . ($i)
                ]);
            }
        }
    }
}
