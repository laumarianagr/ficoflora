<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('entidad_id')->unsigned();
            $table->foreign('entidad_id')->references('id')->on('entidades')->onDelete('cascade');

            $table->integer('localidad_id')->unsigned()->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades')->onDelete('cascade');

            $table->integer('lugar_id')->unsigned()->nullable();
            $table->foreign('lugar_id')->references('id')->on('lugares')->onDelete('cascade');

            $table->integer('sitio_id')->unsigned()->nullable();
            $table->foreign('sitio_id')->references('id')->on('sitios')->onDelete('cascade');

            $table->string('latitud');
            $table->string('longitud');

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
        Schema::drop('ubicaciones');
    }
}
