<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroUbicacionSinonimiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_ubicacion_sinonimia', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('registro_id')->unsigned();
            $table->foreign('registro_id')->references('id')->on('registros')->onDelete('cascade');

            $table->integer('ubicacion_id')->unsigned()->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones')->onDelete('cascade');

            $table->integer('sinonimia_id')->unsigned()->nullable();
            $table->foreign('sinonimia_id')->references('id')->on('sinonimias')->onDelete('cascade');

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
        Schema::drop('registro_ubicacion_sinonimia');
    }
}
