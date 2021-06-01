<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sitios', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->integer('lugar_id')->unsigned();
			$table->timestamps();

            $table->foreign('lugar_id')
                ->references('id')->on('lugares')
                ->onDelete('cascade');

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
		Schema::drop('sitios');
	}

}
