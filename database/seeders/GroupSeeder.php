<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= 10) {
                Group::factory()->create([
                    'group_code' => 'GR' . ($i),
                    'name' => 'Groupe ' . ($i)
                ]);
            } else if ($i <= 9) {
                Group::factory()->create([
                    'group_code' => 'GR0' . ($i),
                    'name' => 'Groupe 0' . ($i)
                ]);
            }
        }
    }
}
