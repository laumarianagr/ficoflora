<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinonimiasEspeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinonimias_especies', function (Blueprint $table) {
            $table->integer('especie_id')->unsigned()->index();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');

            $table->integer('sinonimia_id')->unsigned()->index();
            $table->foreign('sinonimia_id')->references('id')->on('sinonimias')->onDelete('cascade');

            $table->primary(['especie_id', 'sinonimia_id']);

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
        Schema::drop('sinonimias_especies');
    }
}
