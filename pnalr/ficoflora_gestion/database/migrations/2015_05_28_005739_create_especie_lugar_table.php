<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecieLugarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especie_lugar', function(Blueprint $table)
		{
            $table->integer('especie_id')->unsigned()->index();
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade');

            $table->integer('lugar_id')->unsigned()->index();
            $table->foreign('lugar_id')->references('id')->on('lugares')->onDelete('cascade');

            $table->primary(['especie_id', 'lugar_id']);



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
		Schema::drop('especie_lugar');
	}

}
