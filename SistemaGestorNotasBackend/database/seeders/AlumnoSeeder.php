<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumnos')->insert([
            'id' => 1,
            'codigo_alumno' => 'OG2201',
            'nombre_alumno' => 'Jorge José',
            'apellido_alumno' => 'Orellana Guevara',
            'nombre_encargado_alumno' => 'Juan Orellana',
            'nie_alumno' => '161098158',
            'fecha_nacimiento_alumno' => Carbon::createFromDate(2004, 10, 16, 'America/El_Salvador'),
            'id_categoria_alumno' => 1,
            'id_user' => 4,
            'created_at' => Carbon::now()
        ]);
    }
}
