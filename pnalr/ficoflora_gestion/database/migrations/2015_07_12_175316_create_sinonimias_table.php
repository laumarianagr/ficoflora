<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinonimiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinonimias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('genero_id')->unsigned();
            $table->integer('especifico_id')->unsigned();
            $table->integer('varietal_id')->unsigned()->nullable();
            $table->integer('forma_id')->unsigned()->nullable();
            $table->integer('autor_id')->unsigned();
            $table->integer('creador_id')->unsigned();
            $table->timestamps();

            $table->foreign('creador_id')
                ->references('id')->on('usuarios');

            $table->foreign('genero_id')
                ->references('id')->on('generos')
                ->onDelete('cascade');

            $table->foreign('especifico_id')
                ->references('id')->on('epitetos_especificos')
                ->onDelete('cascade');

            $table->foreign('autor_id')
                ->references('id')->on('autores')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sinonimias');
    }
}
