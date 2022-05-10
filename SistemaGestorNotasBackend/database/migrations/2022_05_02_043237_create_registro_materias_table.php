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
        Schema::create('registro_materias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id')->references('id')->on('nivels');
            $table->foreignId('alumno_id')->references('id')->on('alumnos');
            $table->foreignId('materia_id')->references('id')->on('materias');
            $table->foreignId('periodo_evaluativo_id')->references('id')
                ->on('periodo_evaluativos');
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
        Schema::dropIfExists('registro_materias');
    }
};
