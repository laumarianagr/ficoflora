<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias_libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('autores');
            $table->string('fecha');
            $table->string('cita');
            $table->string('cita_html');
            $table->string('letra')->nullable();;
            $table->text('titulo');
            $table->string('edicion')->nullable();
            $table->string('editorial')->nullable();
            $table->string('lugar');
            $table->integer('paginas');
            $table->text('capitulo')->nullable();
            $table->string('editor')->nullable();
            $table->string('intervalo')->nullable();
            $table->string('isbn')->nullable();
            $table->string('doi')->nullable();
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
        Schema::drop('referencias_libros');
    }
}
