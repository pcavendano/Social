<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Mmo\Faker\LoremFacesProvider($this->faker));
        return [
            'id' => $this->faker->unique()->randomNumber(6, true),
            'nom' => $this->faker->name(),
            'adresse' => $this->faker->unique()->address(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'image' => $this->faker->unique()->loremFacesUrl(),
            'email' => $this->faker->unique()->safeEmail(),
            'date_de_naissance' => $this->faker->dateTimeThisCentury(),
            'villeId' => Ville::all()->random(),
            'categorieId' => Type::all()->random(),
            'updated_at' => $this->faker->time(), //Generates a fake sentence
            'created_at' => $this->faker->time()
        ];
    }
}
