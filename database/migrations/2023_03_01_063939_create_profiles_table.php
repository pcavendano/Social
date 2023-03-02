<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('profiles');
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom', 100);
            $table->string('nom', 100);
            $table->longText('adresse');
            $table->string('phone', 20);
            $table->string('email');
            $table->string('image');
            $table->date('date_de_naissance');
            $table->unsignedInteger('villeId')->foreign('villeId')->references('id')->on('villes');
            $table->unsignedInteger('type_id')
                ->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('cascade');
            $table->unsignedInteger('user_id')
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
