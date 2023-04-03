<?php

namespace Database\Factories;

use App\Models\Caso;
use App\Models\TypeStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stage>
 */
class StageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stage_name'=>$this->faker->word(),
            'stage_notes'=>$this->faker->paragraph(),
            'stage_case_id'=>Caso::all()->random()->id,
            'stage_type_stage_id'=>TypeStage::all()->random()->id,
        ];
    }
}
