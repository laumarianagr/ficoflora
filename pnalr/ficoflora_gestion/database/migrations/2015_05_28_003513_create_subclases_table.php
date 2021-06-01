<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubclasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subclases', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre')->unique();
            $table->integer('clase_id')->unsigned();
            $table->integer('creador_id')->unsigned();
            $table->timestamps();

            $table->foreign('creador_id')
                ->references('id')->on('usuarios');


            $table->foreign('clase_id')
                ->references('id')->on('clases')
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
		Schema::drop('subclases');
	}

}
