<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->create([
            'department_id' => 1,
            'department_code' => 'LFANG',
            'name' => 'ANGLAIS'
        ]);

        Department::factory()->create([
            'department_id' => 2,
            'department_code' => 'LFARB',
            'name' => 'ARABE'
        ]);

        Department::factory()->create([
            'department_id' => 3,
            'department_code' => 'LFFRA',
            'name' => 'FRANCAIS'
        ]);

        Department::factory()->create([
            'department_id' => 4,
            'department_code' => 'LPART',
            'name' => 'ARTS ET MÉDIAS'
        ]);

        Department::factory()->create([
            'department_id' => 5,
            'department_code' => 'LPMTA',
            'name' => 'MÉTIERS DE THÉÂTRE ET ARTS DU SPECTACLE'
        ]);
    }
}
