<?php

namespace Database\Seeders;

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
        DB::table('alumnos')->insert
        ([['nombre'=>'Alfonso',
            'apellido'=>'Marin',
            'email'=>'alfonso.marin@escuelaestech.es',
            'edad'=>37,
            'direccion'=>'c/ San Joaquin',
            'created_at'=> date("Y-m-d H:i:s"),
            'updated_at'=> date("Y-m-d H:i:s"),
            ],
            ['nombre'=>'Cayetano',
            'apellido'=>'Ledesma',
            'email'=>'alfonso.marin@escuelaestech.es',
            'edad'=>42,
            'direccion'=>'c/ San Joaquin',
            'created_at'=> date("Y-m-d H:i:s"),
            'updated_at'=> date("Y-m-d H:i:s"),
            ]]);
    }
}
