<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('etudiants');
        Schema::create('etudiants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 100);
            $table->longText('adresse');
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->string('image');
            $table->date('date_de_naissance');
            $table->integer('villeId')->foreign('villeId')->references('id')->on('villes');
            $table->integer('categorieId')->foreign('categorieId')->references('id')->on('types')->onDelete('cascade');
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
        Schema::dropIfExists('etudiants');
    }
}
