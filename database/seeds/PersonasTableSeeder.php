<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++){
            DB::table('ib35a_personas')->insert([
                'nombre' => str_random(10),
                'apellido1' => str_random(10),
                'apellido2' => str_random(10),
                'dni' => '000000'.$i.str_random(1),
                'tlfFijo1' => random_int(100000000,999999999),
                'tlfMovil1' => random_int(100000000,999999999),
                'mail1' => str_random(10).'@gmail.com',
                'direccion' => str_random(20),
                'codpostal' => '28080',
                'codMunicipio' => '4356',
                'tipo' => 'Contrario'
            ]);
        }
    }
}
