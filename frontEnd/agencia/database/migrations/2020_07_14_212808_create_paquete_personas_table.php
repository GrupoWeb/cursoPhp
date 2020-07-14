<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaquetePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquete_personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_persona');
            $table->string('nit');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('estado');
            $table->integer('id_paquete')->unsigned();
            $table->timestamps();

            $table->foreign('id_paquete')->references('id')->on('ofertas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquete_personas');
    }
}
