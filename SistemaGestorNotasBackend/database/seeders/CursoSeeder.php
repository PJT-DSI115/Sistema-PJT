<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            'codigo_curso' => 'MAT',
            'nombre_curso' => 'Matematica',
            'created_at' => Carbon::now()
        ]);
        DB::table('cursos')->insert([
            'codigo_curso' => 'FIS',
            'nombre_curso' => 'Fisica',
            'created_at' => Carbon::now()
        ]);
        DB::table('cursos')->insert([
            'codigo_curso' => 'QUI',
            'nombre_curso' => 'Quimica',
            'created_at' => Carbon::now()
        ]);
        DB::table('cursos')->insert([
            'codigo_curso' => 'BIO',
            'nombre_curso' => 'Biologia',
            'created_at' => Carbon::now()
        ]);
        DB::table('cursos')->insert([
            'codigo_curso' => 'AST',
            'nombre_curso' => 'Astronomia',
            'created_at' => Carbon::now()
        ]);
        DB::table('cursos')->insert([
            'codigo_curso' => 'INF',
            'nombre_curso' => 'Informatica',
            'created_at' => Carbon::now()
        ]);
    }
}
