<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('perfil_id')->unsigned();
            $table->text('descripcion')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('perfil_id')
                ->references('id')->on('perfiles')
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
        Schema::drop('usuarios');
    }
}
