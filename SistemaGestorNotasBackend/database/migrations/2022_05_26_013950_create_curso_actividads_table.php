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
        Schema::create('curso_actividads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nombre_actividad", 10)->nullable($value = false);
            $table->double("porcentaje_actividad", 3, 2)->nullable($value = true);
            $table->string("codigo_activad", 10)->nullable($value = false);
            $table->foreignId("id_curso_actividad")->references("id")->on("curso_actividads")->nullable($value = true);
            $table->foreignId("id_curso")->references("id")->on("cursos");
            $table->foreignId("ip_periodo")->references("id")->on("periodos");
            $table->foreignId("id_nivel")->references("id")->on("nivels");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_actividads');
    }
};
