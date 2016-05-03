<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoRevistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('estado_revista', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('legajo')->unsigned();
            $table->integer('situacion')->unsigned();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin')->nullable();;
            $table->char('estado');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_cambio')->unsigned();

            $table->foreign('legajo')
                ->references('id')
                ->on('employees');
            $table->foreign('situacion')
                ->references('id')
                ->on('conceptos_revista');
            $table->foreign('usuario_cambio')
                ->references('id')
                ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estado_revista');
    }
}
