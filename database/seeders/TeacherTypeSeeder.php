<?php

namespace Database\Seeders;

use App\Models\TeacherType;
use Illuminate\Database\Seeder;

class TeacherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'teacher_type_id' => 1,
                'teacher_type_code' => 'PER',
                'name' => 'Permanente'
            ],
            [
                'teacher_type_id' => 2,
                'teacher_type_code' => 'PVA',
                'name' => 'Vacataire'
            ],
            [
                'teacher_type_id' => 3,
                'teacher_type_code' => 'PDO',
                'name' => 'Doctorant'
            ]
        ];

        foreach ($types as $row) {
            TeacherType::factory()->create($row);
        }
    }
}
