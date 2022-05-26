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
        Schema::create('profesors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nombre_profesor", 100)->nullable($value = false);
            $table->string("apellido_profesor", 100)->nullable($value = false);
            $table->date("fecha_nacimiento_profesor")->nullable($value = false);
            $table->string("dui_profesor", 10)->nullable($value = false);
            $table->foreignId("id_user")->references("id")->on("users")->nullable($value = false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesors');
    }
};
