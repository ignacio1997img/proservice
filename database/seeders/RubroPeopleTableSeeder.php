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
                'created_at' => '2022-05-04 16:47:33',
                'updated_at' => '2022-05-04 16:47:33',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Jardinero',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-09 10:28:45',
                'updated_at' => '2022-05-09 11:36:02',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Piscinero',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-09 10:28:45',
                'updated_at' => '2022-05-09 11:36:02',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Modelos',
                'description' => NULL,
                'image' => NULL,
                'status' => 0,
                'created_at' => '2022-05-09 10:28:45',
                'updated_at' => '2022-11-15 22:19:56',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Sistemas de Seguridad',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-11-15 22:24:31',
                'updated_at' => '2022-11-15 22:24:31',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}