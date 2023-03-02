<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**hpp
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_path = resource_path('sql/whatever.sql');

        \DB::unprepared(
            file_get_contents($file_path)
        );
    }
}
