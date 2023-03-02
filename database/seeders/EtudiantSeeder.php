<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;
use Illuminate\Database\Seeder;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etudiant::factory(100)
            ->create()
            ->each(function ($user) {
                User::factory()
                    ->create(['email' => $user->email]);
            });
    }
}
