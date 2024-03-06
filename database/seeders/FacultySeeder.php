<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faculties = [
            [
                'faculty_id' => 1,
                'faculty_code' => 'FLLA',
                'name' => 'Faculté des Langues, des Lettres et des Arts',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 2,
                'faculty_code' => 'FSHS',
                'name' => 'Faculté des Sciences Humaines et Sociales',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 3,
                'faculty_code' => 'FS',
                'name' => 'Faculté des Sciences',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 4,
                'faculty_code' => 'ENCG',
                'name' => 'Ecole Nationale de Commerce et de Gestion',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 5,
                'faculty_code' => 'EST',
                'name' => 'Ecole Supérieure de Technologie',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 6,
                'faculty_code' => 'ENSC',
                'name' => 'Ecole Nationale Supérieure de Chimie',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 7,
                'faculty_code' => 'IMS',
                'name' => 'Institut des Métiers de Sport',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 8,
                'faculty_code' => 'FSJP',
                'name' => 'Faculté des Sciencers Juridiques et Politiques',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 9,
                'faculty_code' => 'FEG',
                'name' => 'Faculté d\'Economie et de Gestion',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 10,
                'faculty_code' => 'ENSA',
                'name' => 'Ecole Nationale des Sciences Appliquées',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 11,
                'faculty_code' => 'ESEF',
                'name' => 'Ecole Supérieure de l\'Education et de la Formation',
                'university_id' => 1, //UIT
            ],
            [
                'faculty_id' => 12,
                'faculty_code' => 'CUFCC',
                'name' => 'Centre Universitaire de Formation Continue et de Conférences',
                'university_id' => 1, //UIT
            ],
        ];

        foreach ($faculties as $row) {
            Faculty::factory()->create($row);
        }
    }
}
