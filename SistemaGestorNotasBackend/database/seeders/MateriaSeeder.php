<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materias')->insert([
            'codigo_materia' => "MAT",
            'nombre_materia' => "Matemitica"
        ]);
        DB::table('materias')->insert([
            'codigo_materia' => "FIS",
            'nombre_materia' => "Fisica"
        ]);
        DB::table('materias')->insert([
            'codigo_materia' => "QUI",
            'nombre_materia' => "Quimica"
        ]);
        DB::table('materias')->insert([
            'codigo_materia' => "BIO",
            'nombre_materia' => "Biologia"
        ]);
        DB::table('materias')->insert([
            'codigo_materia' => "FT",
            'nombre_materia' => "Informatica"
        ]);
        DB::table('materias')->insert([
            'codigo_materia' => "AST",
            'nombre_materia' => "Astronomia"
        ]);
    }
}
