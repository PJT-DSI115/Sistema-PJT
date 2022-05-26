<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'codigo_rol' => '1',
            'nombre_rol' => 'Administrador'
        ]);
        DB::table('rols')->insert([
            'codigo_rol' => '2',
            'nombre_rol' => 'Docente'
        ]);
        DB::table('rols')->insert([
            'codigo_rol' => '3',
            'nombre_rol' => 'Alumno'
        ]);
    }
}
