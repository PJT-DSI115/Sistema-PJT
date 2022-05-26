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
        Schema::create('tipo_alumnos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("codigo_tipo_alumno", 5)->nullable($value = false)->unique();
            $table->string("nombre_tipo_alumno", 50)->nullable($value = false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_alumnos');
    }
};
