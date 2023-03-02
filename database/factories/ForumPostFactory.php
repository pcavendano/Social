<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\ForumPost;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ForumPostFactory extends Factory
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
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph(20),
            'user_id' => User::factory(),
            'categorys_id' => Category::all()->random(),
        ];
    }
}
