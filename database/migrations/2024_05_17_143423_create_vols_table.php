<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vols', function (Blueprint $table) {
            $table->id();
            $table->string('compagnie_aerienne');
            $table->string('numero_de_vol');
            $table->dateTime('date_depart');
            $table->dateTime('date_arrivee');
            $table->string('lieu_depart');
            $table->string('lieu_arrivee');
            $table->integer('places_disponibles');
            $table->float('prix');
            $table->string('image',255);

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
        Schema::dropIfExists('vols');
    }
};
