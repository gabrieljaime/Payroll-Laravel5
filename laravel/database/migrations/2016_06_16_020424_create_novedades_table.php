<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovedadesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('novedades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('legajo');
			$table->date('fecha_novedad');
			$table->integer('tipo_novedad');
			$table->integer('cantidad');
			$table->integer('concepto_id');
			$table->integer('codigo');
			$table->text('estado');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('novedades');
	}

}
