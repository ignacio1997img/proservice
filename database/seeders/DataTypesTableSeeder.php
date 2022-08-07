<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-06-02 13:55:30',
                'updated_at' => '2021-06-02 13:55:30',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-06-02 13:55:30',
                'updated_at' => '2021-06-02 13:55:30',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2021-06-02 13:55:31',
                'updated_at' => '2021-06-02 13:55:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'rubro_busines',
                'slug' => 'rubro-busines',
                'display_name_singular' => 'Rubro Empresa',
                'display_name_plural' => 'Rubro Empresas',
                'icon' => 'voyager-group',
                'model_name' => 'App\\Models\\RubroBusine',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2022-05-04 05:54:24',
                'updated_at' => '2022-05-04 05:54:24',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'rubro_people',
                'slug' => 'rubro-people',
                'display_name_singular' => 'Rubro Persona',
                'display_name_plural' => 'Rubro Personas',
                'icon' => 'voyager-people',
                'model_name' => 'App\\Models\\RubroPeople',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2022-05-04 05:57:07',
                'updated_at' => '2022-05-04 05:57:07',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'countries',
                'slug' => 'countries',
                'display_name_singular' => 'País',
                'display_name_plural' => 'Paises',
                'icon' => 'fa-solid fa-earth-americas',
                'model_name' => 'App\\Models\\Country',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-17 11:21:52',
                'updated_at' => '2022-06-17 11:27:48',
            ),
            6 => 
            array (
                'id' => 12,
                'name' => 'departments',
                'slug' => 'departments',
                'display_name_singular' => 'Departamento',
                'display_name_plural' => 'Departamentos',
                'icon' => 'fa-solid fa-building',
                'model_name' => 'App\\Models\\Department',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}',
                'created_at' => '2022-06-25 15:43:46',
                'updated_at' => '2022-06-25 15:43:46',
            ),
            7 => 
            array (
                'id' => 13,
                'name' => 'cities',
                'slug' => 'cities',
                'display_name_singular' => 'Ciudad',
                'display_name_plural' => 'Ciudades',
                'icon' => 'fa-solid fa-city',
                'model_name' => 'App\\Models\\City',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-25 15:46:29',
                'updated_at' => '2022-06-25 15:48:21',
            ),
            8 => 
            array (
                'id' => 14,
                'name' => 'professions',
                'slug' => 'professions',
                'display_name_singular' => 'Profession',
                'display_name_plural' => 'Professions',
                'icon' => 'fa-solid fa-user-doctor',
                'model_name' => 'App\\Models\\Profession',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-08-07 10:12:25',
                'updated_at' => '2022-08-07 10:15:31',
            ),
        ));
        
        
    }
}