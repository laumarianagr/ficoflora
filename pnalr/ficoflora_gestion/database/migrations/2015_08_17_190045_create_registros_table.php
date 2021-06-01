<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('especie_id')->unsigned()->index();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');

            $table->integer('referencia_id')->unsigned()->index();

            //para saber en que tabla de referencias buscar
            $table->string('tipo_referencia');
            $table->text('comentario')->nullable();


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
        Schema::drop('registros');
    }
}
