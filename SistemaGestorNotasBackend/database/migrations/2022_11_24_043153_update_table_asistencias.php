<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistencias', function(Blueprint $table){
            $table->dropForeign('asistencias_id_periodo_foreign');
            $table->dropColumn('id_periodo');
            $table->dropForeign('asistencias_id_alumno_foreign');
            $table->dropColumn('id_alumno');
            $table->unsignedBigInteger('id_carga_academica');
            $table->foreign('id_carga_academica')->references('id')->on('carga_academicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
