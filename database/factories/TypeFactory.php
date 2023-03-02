<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(6, true),
            'nom' => $this->faker->jobTitle(),
            'slug' => $this->faker->title(),
            'updated_at' => $this->faker->time(), //Generates a fake sentence
            'created_at' => $this->faker->time()
        ];
    }
}
