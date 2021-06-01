<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('autor');
            $table->string('forma')->nullable();
            $table->string('varietal')->nullable();
            $table->string('especifico');
            $table->string('genero');
            $table->string('familia');
            $table->string('orden');
            $table->string('subclase')->nullable();
            $table->string('clase');
            $table->string('phylum');
            $table->string('referencia');
            $table->string('referencia_tipo');
            $table->string('sinonimias')->nullable();
            $table->string('ubicacion')->nullable();
            $table->integer('creador_id')->unsigned();
            $table->foreign('creador_id')->references('id')->on('usuarios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('temporales');
    }
}
