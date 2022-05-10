<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N1',
            'nombre_nivel' => 'Nivel 1'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N2',
            'nombre_nivel' => 'Nivel 2'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N3',
            'nombre_nivel' => 'Nivel 3'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N4',
            'nombre_nivel' => 'Nivel 4'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N5',
            'nombre_nivel' => 'Nivel 5'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N6',
            'nombre_nivel' => 'Nivel 6'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N7',
            'nombre_nivel' => 'Nivel 7'
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N8',
            'nombre_nivel' => 'Nivel 8'
        ]);
        
    }
}
