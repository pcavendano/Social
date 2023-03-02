<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ForumPost;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::all()
            ->random()
            ->each(function ($user) {
                ForumPost::factory()
                    ->create(['user_id' => $user->id,'categorys_id' => Category::all()->random()]);
            });
    }
}
