<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('actividad');
            $table->string('usuario');
            $table->string('elemento');
            $table->integer('id_elem')->nullable();
            $table->string('ruta')->nullable();
            $table->string('proceso')->nullable();
            $table->string('anterior')->nullable();
            $table->string('nuevo')->nullable();
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
        Schema::drop('logs');
    }
}
