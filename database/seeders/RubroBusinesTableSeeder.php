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
                'name' => 'Empresa de Seguridad Fisical',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:33:47',
                'updated_at' => '2022-05-04 10:33:47',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Empresa de Jardineria',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:34:10',
                'updated_at' => '2022-05-04 10:34:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Empresa de Limpieza',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:34:29',
                'updated_at' => '2022-05-04 10:34:29',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Empresa de Servicios electricos',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:34:40',
                'updated_at' => '2022-05-04 10:34:40',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Empresa de Media Marketing',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:34:56',
                'updated_at' => '2022-05-04 10:34:56',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Empresa de limpieza de Piscinas',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:35:06',
                'updated_at' => '2022-05-04 10:35:06',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Empresa de Instalación de Aire Acondicionado',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:35:24',
                'updated_at' => '2022-05-04 10:35:24',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Empresa de sistemas de seguridad',
                'description' => NULL,
                'image' => NULL,
                'status' => 1,
                'created_at' => '2022-05-04 10:35:36',
                'updated_at' => '2022-05-04 10:35:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}