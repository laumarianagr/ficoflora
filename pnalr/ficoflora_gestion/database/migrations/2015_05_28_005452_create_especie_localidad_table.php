<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecieLocalidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especie_localidad', function(Blueprint $table)
		{
            $table->integer('especie_id')->unsigned()->index();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');

            $table->integer('localidad_id')->unsigned()->index();
            $table->foreign('localidad_id')->references('id')->on('localidades')->onDelete('cascade');

            $table->primary(['especie_id', 'localidad_id']);



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
		Schema::drop('especie_localidad');
	}

}
