<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonStage>
 */
class PersonStageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_stage_person_id'=> Person::all()->random()->id,
            'person_stage_stage_id'=>Stage::all()->random()->id,
        ];
    }
}
