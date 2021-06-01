<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias_trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('autores');
            $table->string('fecha');
            $table->string('cita');
            $table->string('cita_html');
            $table->string('letra')->nullable();;
            $table->text('titulo');
            $table->string('institucion');
            $table->string('lugar');
            $table->integer('paginas');
            $table->string('enlace')->nullable();
            $table->string('archivo')->nullable();
            $table->string('comentarios')->nullable();
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
        Schema::drop('referencias_trabajos');
    }
}
