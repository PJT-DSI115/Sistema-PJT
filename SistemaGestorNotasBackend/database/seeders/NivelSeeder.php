<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'codigo_nivel' => 'N3',
            'nombre_nivel' => 'Nivel 3',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N4',
            'nombre_nivel' => 'Nivel 4',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N5',
            'nombre_nivel' => 'Nivel 5',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N6',
            'nombre_nivel' => 'Nivel 6',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N7',
            'nombre_nivel' => 'Nivel 7',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N8',
            'nombre_nivel' => 'Nivel 8',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N9',
            'nombre_nivel' => 'Nivel 9',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N10',
            'nombre_nivel' => 'Nivel 10',
            'created_at' => Carbon::now()
        ]);
        DB::table('nivels')->insert([
            'codigo_nivel' => 'N11',
            'nombre_nivel' => 'Nivel 11',
            'created_at' => Carbon::now()
        ]);
    }
}
