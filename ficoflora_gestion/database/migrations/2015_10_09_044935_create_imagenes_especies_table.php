<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesEspeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_especies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('imagen')->unique();
            $table->integer('especie_id')->nullable();
            $table->string('tipo');
            $table->string('leyenda');
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
        Schema::drop('imagenes_especies');
    }
}
