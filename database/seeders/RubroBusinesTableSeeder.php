<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RubroBusinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rubro_busines')->delete();
        
        \DB::table('rubro_busines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Empresa de Seguridad Fisica',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 06:33:47',
                'updated_at' => '2022-05-04 06:33:47',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Empresa de Jardineria',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 06:34:10',
                'updated_at' => '2022-05-04 06:34:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Empresa de limpieza de Piscinas',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 06:35:06',
                'updated_at' => '2022-05-04 06:35:06',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Empresa de Modelos',
                'description' => NULL,
                'image' => NULL,
                'status' => 0,
                'created_at' => '2022-05-04 06:35:06',
                'updated_at' => '2022-11-15 22:20:11',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Sistemas de Seguridad',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-11-15 22:26:07',
                'updated_at' => '2022-11-15 22:26:07',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}