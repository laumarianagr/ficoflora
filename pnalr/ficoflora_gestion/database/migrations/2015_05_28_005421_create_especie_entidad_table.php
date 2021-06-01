<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecieEntidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especie_entidad', function(Blueprint $table)
		{
            $table->integer('especie_id')->unsigned()->index();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');

            $table->integer('entidad_id')->unsigned()->index();
            $table->foreign('entidad_id')->references('id')->on('entidades')->onDelete('cascade');

            $table->primary(['especie_id', 'entidad_id']);



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
		Schema::drop('especie_entidad');
	}

}
