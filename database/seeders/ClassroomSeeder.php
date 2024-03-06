<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $classrooms = [
            [
                "classroom_id" => 1,
                "classroom_code" => "FLLA_SALLE_01",
                "name" => "SALLE 01",
                "cours_seats" => 112,
                "exam_seats" => 56,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 2,
                "classroom_code" => "FLLA_SALLE_02",
                "name" => "SALLE 02",
                "cours_seats" => 112,
                "exam_seats" => 56,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 3,
                "classroom_code" => "FLLA_SALLE_03",
                "name" => "SALLE 03",
                "cours_seats" => 260,
                "exam_seats" => 130,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 4,
                "classroom_code" => "FLLA_SALLE_04",
                "name" => "SALLE 04",
                "cours_seats" => 112,
                "exam_seats" => 56,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 5,
                "classroom_code" => "FLLA_SALLE_05",
                "name" => "SALLE 05",
                "cours_seats" => 220,
                "exam_seats" => 110,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 6,
                "classroom_code" => "FLLA_SALLE_06",
                "name" => "SALLE 06",
                "cours_seats" => 112,
                "exam_seats" => 56,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 7,
                "classroom_code" => "FLLA_SALLE_09",
                "name" => "SALLE 09",
                "cours_seats" => 220,
                "exam_seats" => 110,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 8,
                "classroom_code" => "FLLA_SALLE_10",
                "name" => "SALLE 10",
                "cours_seats" => 112,
                "exam_seats" => 56,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 9,
                "classroom_code" => "FLLA_SALLE_11",
                "name" => "SALLE 11",
                "cours_seats" => 112,
                "exam_seats" => 56,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 10,
                "classroom_code" => "FLLA_SALLE_12",
                "name" => "SALLE 12",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 11,
                "classroom_code" => "FLLA_SALLE_13",
                "name" => "SALLE 13",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 12,
                "classroom_code" => "FLLA_SALLE_14",
                "name" => "SALLE 14",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 13,
                "classroom_code" => "FLLA_SALLE_15",
                "name" => "SALLE 15",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 14,
                "classroom_code" => "FLLA_SALLE_16",
                "name" => "SALLE 16",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 15,
                "classroom_code" => "FLLA_SALLE_17",
                "name" => "SALLE 17",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 16,
                "classroom_code" => "FLLA_SALLE_18",
                "name" => "SALLE 18",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 17,
                "classroom_code" => "FLLA_SALLE_19",
                "name" => "SALLE 19",
                "cours_seats" => 96,
                "exam_seats" => 48,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 18,
                "classroom_code" => "FLLA_PAV_01",
                "name" => "PAV 01",
                "cours_seats" => 160,
                "exam_seats" => 80,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 19,
                "classroom_code" => "FLLA_PAV_02",
                "name" => "PAV 02",
                "cours_seats" => 160,
                "exam_seats" => 80,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 20,
                "classroom_code" => "FLLA_PAV_03",
                "name" => "PAV 03",
                "cours_seats" => 60,
                "exam_seats" => 30,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 21,
                "classroom_code" => "FLLA_AMPHI_A",
                "name" => "AMPHI A",
                "cours_seats" => 320,
                "exam_seats" => 160,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 22,
                "classroom_code" => "FLLA_AMPHI_B",
                "name" => "AMPHI B",
                "cours_seats" => 320,
                "exam_seats" => 160,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
            [
                "classroom_id" => 23,
                "classroom_code" => "FLLA_AMPHI_C",
                "name" => "AMPHI C",
                "cours_seats" => 500,
                "exam_seats" => 250,
                "supervisors_capacity" => 3,
                "faculty_id" => 1,
            ],
        ];

        foreach ($classrooms as $row) {
            Classroom::factory()->create($row);
        }
    }
}
