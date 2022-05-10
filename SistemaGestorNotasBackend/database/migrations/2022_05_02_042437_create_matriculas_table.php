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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_matricula');
            $table->foreignId('evento_id')->references('id')->on('eventos');
            $table->foreignId('alumno_id')->references('id')->on('alumnos');
            $table->foreignId('periodo_evaluativo_id')->references('id')
                                                      ->on('periodo_evaluativos');
            $table->foreignId('nivel_id')->references('id')->on('nivels');
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
        Schema::dropIfExists('matriculas');
    }
};
