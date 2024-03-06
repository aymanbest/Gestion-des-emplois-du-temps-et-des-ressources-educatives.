<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Your CSV data
        $csvData = [
            ['class_id' => 1, 'class_code' => 'FLANGLG', 'name' => 'Etudes anglaises linguistique', 'department_id' => 1],
            ['class_id' => 2, 'class_code' => 'FLANGLT', 'name' => 'Etudes anglaises Littérat', 'department_id' => 1],
            ['class_id' => 3, 'class_code' => 'FLARALG', 'name' => 'Etudes arabes linguistique', 'department_id' => 2],
            ['class_id' => 4, 'class_code' => 'FLARALT', 'name' => 'Licence en Etudes arabes littérature', 'department_id' => 2],
            ['class_id' => 5, 'class_code' => 'FLFRADD', 'name' => 'Etudes Françaises  Didactique des langues et des cultures', 'department_id' => 3],
            ['class_id' => 6, 'class_code' => 'FLFRALG', 'name' => 'Etudes françaises linguistique', 'department_id' => 3],
            ['class_id' => 7, 'class_code' => 'FLFRALT', 'name' => 'Etudes françaises Littérature', 'department_id' => 3],
            ['class_id' => 8, 'class_code' => 'LFARABE', 'name' => 'Licence en Etudes arabes', 'department_id' => 2],
            ['class_id' => 9, 'class_code' => 'LFENGLI', 'name' => 'Licence en études anglaises', 'department_id' => 1],
            ['class_id' => 10, 'class_code' => 'LFFRANC', 'name' => 'Licence en études françaises', 'department_id' => 3],
            ['class_id' => 11, 'class_code' => 'LPMARTM', 'name' => 'Les métiers Artistiques et Médiatiques', 'department_id' => 4],
            ['class_id' => 12, 'class_code' => 'LPMARTS', 'name' => 'Les métiers de Théâtre et Arts du spectacle', 'department_id' => 5],
            ['class_id' => 13, 'class_code' => 'PLMARAV', 'name' => 'Les métiers Artistiques et Médiatiques opt: audiovisuel', 'department_id' => 4],
            ['class_id' => 14, 'class_code' => 'PLMARDG', 'name' => 'Les métiers Artistiques et Médiatiques opt: Design graphique', 'department_id' => 4],
            ['class_id' => 15, 'class_code' => 'PLMTHAC', 'name' => 'Les métiers de Théâtre et Arts du spectacle', 'department_id' => 5],
            ['class_id' => 16, 'class_code' => 'PLMTHSC', 'name' => 'Les métiers de Théâtre et Arts du spectacle opt Scénographie', 'department_id' => 5],
        ];

        foreach ($csvData as $data) {
            Classes::factory()->create([
                'class_id' => $data['class_id'],
                'class_code' => $data['class_code'],
                'name' => $data['name'],
                'department_id' => $data['department_id'],
            ]);
        }
    }
}
