<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspeciesTemporalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especies_temporal', function (Blueprint $table) {

            $table->increments('id');
            $table->string('genero');
            $table->string('especifico');
            $table->string('varietal');
            $table->string('forma');
            $table->string('descripcion');
            $table->string('autor');
            $table->string('familia');
            $table->string('orden');
            $table->string('subclase');
            $table->string('clase');
            $table->string('phylum');
            $table->integer('creador_id')->unsigned();
            $table->timestamps();

            $table->foreign('creador_id')
                ->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('especies_temporal');
    }
}
