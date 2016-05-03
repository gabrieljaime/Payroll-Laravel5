<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMotivoRevistaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estado_revista', function (Blueprint $table)
        {
            $table->string('motivo')->after('situacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estado_revista', function (Blueprint $table)
        {
            $table->dropColumn('motivo');
        });
    }
}
