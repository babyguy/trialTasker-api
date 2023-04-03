<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'per_name' => $this->faker->firstName,
            'per_lastname' => $this->faker->lastName,
            'per_email' => $this->faker->unique()->safeEmail,
            'per_phone' => $this->faker->phoneNumber,
            'per_address' => $this->faker->address,
            'per_nit' => $this->faker->randomNumber(8),
            'per_issue_nit' => $this->faker->randomNumber(8),
            'per_num_ministry' => $this->faker->randomNumber(8),
            'per_num_dispaych' => $this->faker->randomNumber(8),
            'per_radicated' => $this->faker->randomNumber(8),
            'per_authority' => $this->faker->randomNumber(8),
            'per_number' => $this->faker->randomNumber(8),
            'per_type_person_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
