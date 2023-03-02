<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VilleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(5, true), //Generates a Ville from factory and extracts id...
            'nom' => $this->faker->city(), //Generates a fake sentence
            'updated_at' => $this->faker->time(), //Generates a fake sentence
            'created_at' => $this->faker->time()
        ];
    }
}
