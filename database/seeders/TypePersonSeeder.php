<?php

namespace Database\Seeders;

use App\Models\TypePerson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typePersons = [
            [
                'type_person_name' => 'Cliente',
            ],
            [
                'type_person_name' => 'Juez',
            ],
            [
                'type_person_name' => 'Fiscal',
            ],
            [
                'type_person_name' => 'Contraparte',
            ],
        ];

        foreach ($typePersons as $typePerson) {
            TypePerson::create($typePerson);
        }
    }
}
