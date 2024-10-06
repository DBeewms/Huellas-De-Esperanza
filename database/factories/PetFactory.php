<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->name,
            'breed' => $this->faker->word,
            'dob' => $this->faker->date,
            'photo' => $this->faker->optional()->imageUrl,
            'description' => $this->faker->optional()->text,
            'status' => $this->faker->boolean(true),
            'pet_type_id' => \App\Models\PetType::factory(),
        ];
    }
}
