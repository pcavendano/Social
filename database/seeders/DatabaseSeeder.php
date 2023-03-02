<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $student = Type::create([
            'nom' => 'Étudiant',
            'slug' => 'student'
        ]);
        $teacher = Type::create([
            'nom' => 'Professeur',
            'slug' => 'teacher'
        ]);
        $visiteur = Type::create([
            'nom' => 'Visiteur',
            'slug' => 'visiteur'
        ]);
        $this->call(VilleSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EtudiantSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ForumPostSeeder::class);
    }
}
