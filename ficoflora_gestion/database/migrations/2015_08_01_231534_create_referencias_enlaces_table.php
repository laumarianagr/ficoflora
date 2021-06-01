<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasEnlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias_enlaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('autores')->nullable();
            $table->string('fecha')->nullable();
            $table->string('cita');
            $table->string('letra')->nullable();
            $table->string('nombre')->nullable();
            $table->string('titulo')->nullable();
            $table->string('institucion')->nullable();
            $table->string('lugar')->nullable();
            $table->string('enlace');
            $table->integer('dia');
            $table->string('mes');
            $table->integer('ano');
            $table->integer('creador_id')->unsigned();
            $table->foreign('creador_id')->references('id')->on('usuarios');
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
        Schema::drop('referencias_enlaces');
    }
}
