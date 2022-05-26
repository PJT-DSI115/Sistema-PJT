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
        Schema::create('registro_nota_curso_actividads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal("nota_registro_nota_curso_actividad", 9,2)->default(0)->nullable($value = false);
            $table->integer("mes_registro_nota_curso_actividad")->nullable($value = false);
            $table->foreignId("id_curso_actividad")->references("id")->on("curso_actividads");
            $table->foreignId("id_carga_academica")->references("id")->on("carga_academicas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_nota_curso_actividads');
    }
};
