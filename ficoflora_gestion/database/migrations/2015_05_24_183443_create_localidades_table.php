<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localidades', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->integer('entidad_id')->unsigned();
            $table->timestamps();

            $table->foreign('entidad_id')
                ->references('id')->on('entidades')
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
		Schema::drop('localidades');
	}

}
