<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('citas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('autores');
            $table->integer('fecha');
            $table->string('letra')->nullable();
            $table->string('tipo');
            $table->integer('referencia_id')->unsigned()->onDelete('cascade');;
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
		Schema::drop('citas');
	}

}
