<?php

namespace Database\Seeders;

use App\Models\TypeStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeStage = [
            [
                'type_stage_name' => 'Indagacion',
            ],
            [
                'type_stage_name' => 'Inputacion',
            ],
            [
                'type_stage_name' => 'Acusacion',
            ],
            [
                'type_stage_name' => 'Preparatoria',
            ],
            [
                'type_stage_name' => 'Audiencias orales',
            ],
            [
                'type_stage_name' => 'Apelacion',
            ],
            [
                'type_stage_name' => 'Condena',
            ],
        ];

        foreach ($typeStage as $typePerson) {
            TypeStage::create($typePerson);
        }
    }
}
