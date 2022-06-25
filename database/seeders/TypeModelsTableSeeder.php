<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeModelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('type_models')->delete();
        
        \DB::table('type_models')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Modelos Profesionales',
                'image' => NULL,
                'description' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Modelos Standard',
                'image' => NULL,
                'description' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Azafatas/Impulsadore',
                'image' => NULL,
                'description' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}