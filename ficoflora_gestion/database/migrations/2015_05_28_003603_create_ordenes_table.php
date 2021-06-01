<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre')->unique();
            $table->integer('clase_id')->unsigned();
            $table->integer('subclase_id')->unsigned()->nullable();
            $table->integer('creador_id')->unsigned();
            $table->timestamps();

            $table->foreign('creador_id')
                ->references('id')->on('usuarios');

            $table->foreign('clase_id')
                ->references('id')->on('clases')
                ->onDelete('cascade');

            $table->foreign('subclase_id')
                ->references('id')->on('subclases')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ordenes');
	}

}
