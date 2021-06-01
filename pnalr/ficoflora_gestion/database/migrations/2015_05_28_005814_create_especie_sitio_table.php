<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecieSitioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especie_sitio', function(Blueprint $table)
		{
            $table->integer('especie_id')->unsigned()->index();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');

            $table->integer('sitio_id')->unsigned()->index();
            $table->foreign('sitio_id')->references('id')->on('sitios')->onDelete('cascade');

            $table->primary(['especie_id', 'sitio_id']);



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
		Schema::drop('especie_sitio');
	}

}
