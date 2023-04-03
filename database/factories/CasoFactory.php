<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */

 class CasoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'case_name' => $this->faker->name(),
            'case_radicate' => $this->faker->randomNumber(9),
            'case_status' => $this->faker->boolean(),
            'case_user_id'=>User::all()->random()->id,
            'case_person_id'=>Person::all()->random()->id,
        ];
    }
}
