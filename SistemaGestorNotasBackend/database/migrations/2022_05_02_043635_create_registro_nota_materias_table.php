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
        Schema::create('registro_nota_materias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_evaluativo_id')->references('id')
                                                      ->on('periodo_evaluativos');
            $table->foreignId('actividad_id')->references('id')->on('actividads');
            $table->foreignId('registro_materia_id')->references('id')->on('registro_materias');
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
        Schema::dropIfExists('registro_nota_materias');
    }
};
