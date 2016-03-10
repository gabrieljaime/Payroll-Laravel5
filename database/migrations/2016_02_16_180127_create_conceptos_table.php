<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConceptosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('codigo');
            $table->string('detalle');
            $table->string('retencion', 1);
            $table->string('familia', 1);
            $table->string('haberdebe', 1);
            $table->string('sumaresta', 1);
            $table->string('for', 1);
            $table->decimal('importe', 17, 4);
            $table->decimal('porcentaje', 5, 2);
            $table->string('por_sobre', 1);
            $table->string('esfijo', 1);
            $table->string('imp_por', 1);
            $table->string('reintegro', 1);
            $table->string('basico', 1);
            $table->string('con_carga', 1);
            $table->string('es_formula', 1);
            $table->string('quefor', 1)->nullable();
            $table->integer('ero1');
            $table->string('manual', 1);
            $table->string('HBLF', 1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('concepto_specialty', function (Blueprint $table)
        {
            $table->integer('concepto_id')->unsigned();
            $table->integer('specialty_id')->unsigned();
            $table->integer('basico');
            $table->foreign('concepto_id')
                ->references('id')
                ->on('conceptos')
                ->onDelete('cascade');
            $table->foreign('specialty_id')
                ->references('id')
                ->on('specialties')
                ->onDelete('cascade');
        });
        Schema::create('conceptofijo', function (Blueprint $table)
        {
            $table->integer('concepto_id')->unsigned();
            $table->integer('employees_id')->unsigned();
            $table->integer('importe');
            $table->integer('cantidad')->nullable();
            $table->timestamps();
            $table->foreign('concepto_id')
                ->references('id')
                ->on('conceptos')
                ->onDelete('cascade');
            $table->foreign('employe_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
        });
        Schema::create('conceptovariable', function (Blueprint $table)
        {
            $table->integer('concepto_id')->unsigned();
            $table->integer('employees_id')->unsigned();
            $table->integer('año');
            $table->integer('mes');
            $table->integer('importe');
            $table->integer('cantidad')->nullable();
            $table->timestamps();
            $table->foreign('concepto_id')
                ->references('id')
                ->on('conceptos')
                ->onDelete('cascade');
            $table->foreign('employe_id')
                ->references('id')
                ->on('employees')
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
        Schema::drop('concepto_specialty');
        Schema::drop('conceptofijo');
        Schema::drop('conceptomes');
        Schema::drop('conceptos');
    }

}
