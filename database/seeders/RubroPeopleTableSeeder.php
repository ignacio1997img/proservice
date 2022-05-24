<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RubroPeopleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rubro_people')->delete();
        
        \DB::table('rubro_people')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Guardia de Seguridad',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 20:47:33',
                'updated_at' => '2022-05-04 20:47:33',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Jardinero',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-09 14:28:45',
                'updated_at' => '2022-05-09 15:36:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}