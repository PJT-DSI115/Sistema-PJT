<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'jason',
            'password' => Hash::make('password'),
            'id_role' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'username' => 'eduardo',
            'password' => Hash::make('password'),
            'id_role' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'username' => 'juan',
            'password' => Hash::make('password'),
            'id_role' => 2,
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'username' => 'alumno',
            'password' => Hash::make('password'),
            'id_role' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'username' => 'coordinador',
            'password' => Hash::make('password'),
            'id_role' => 4,
            'created_at' => Carbon::now()
        ]);
    }
}
