<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('autores', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre')->unique();
            $table->integer('creador_id')->unsigned();
            $table->timestamps();

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
		Schema::drop('autores');
	}

}
