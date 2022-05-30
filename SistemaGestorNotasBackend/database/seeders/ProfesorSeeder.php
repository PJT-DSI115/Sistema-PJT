<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('profesors')->insert([
            'nombre_profesor' => 'Juan Antonio',
            'apellido_profesor' => 'Rivera',
            'fecha_nacimiento_profesor' => '1970-05-27',
            'dui_profesor' => '12345678-1'
        ]);
        DB::table('profesors')->insert([
            'nombre_profesor' => 'Carlor Eduardo',
            'apellido_profesor' => 'Gonzales',
            'fecha_nacimiento_profesor' => '1960-05-27',
            'dui_profesor' => '12345679-1'
        ]);
        DB::table('profesors')->insert([
            'nombre_profesor' => 'Veronica Raquel',
            'apellido_profesor' => 'Guerra',
            'fecha_nacimiento_profesor' => '1980-05-27',
            'dui_profesor' => '12345678-9'
        ]);
    }
}
