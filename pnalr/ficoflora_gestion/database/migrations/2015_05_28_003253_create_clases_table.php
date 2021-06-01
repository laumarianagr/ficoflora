<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clases', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre')->unique();
            $table->integer('phylum_id')->unsigned();
            $table->integer('creador_id')->unsigned();
            $table->timestamps();

            $table->foreign('creador_id')
                ->references('id')->on('usuarios');


            $table->foreign('phylum_id')
                ->references('id')->on('phylums')
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
		Schema::drop('clases');
	}

}
