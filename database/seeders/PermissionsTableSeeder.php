<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {

        \DB::table('permissions')->delete();
        
        Permission::firstOrCreate([
            'key'        => 'browse_admin',
            'table_name' => 'admin',
        ]);
        
        // \DB::table('permissions')->delete();
        


        // Permission::firstOrCreate([
        //     'key'        => 'browse_admin',
        //     // 'key'        => 'browse_clear-cache',
        //     'table_name' => 'admin',
        // ]);
        $keys = [
            // 'browse_admin',
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
            'browse_clear-cache',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('settings');

        Permission::generateFor('departments');
        Permission::generateFor('cities');

        Permission::generateFor('rubro_busines');
        Permission::generateFor('busines');

        Permission::generateFor('rubro_people');        
        Permission::generateFor('people');
        Permission::generateFor('professions');


    //############### TRABAJADORES ######################

        //paar ver el perfil de la persona
        // Permission::generateFor('people-perfil-experience');
        $keys = [
            'browse_people-perfil-experience',
            'edit_people-perfil-data',
            'add_people-perfil-experience',
            'edit_people-perfil-requirement',
            'delete_people-perfil-requirement',

            
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'people-perfil-experience',
            ]);
        }

        
        $keys = [
            'browse_message-people-bandeja'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'message-people-bandeja',
            ]);
        }

//____________________________________-________________________________


//############### BUSINESS ######################

        $keys = [
            'browse_busines_perfil_view',
            'edit_busine-perfil-data',
            'add_busine-perfil-requirement',
            'view_busine-perfil-requirement',
            // 'edit_people-perfil-requirement',
            // 'delete_people-perfil-experience',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'busine-perfil-experience',
            ]);
        }

        
        $keys = [
            'browse_message-busine-bandeja'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'message-busine-bandeja',
            ]);
        }

        $keys = [
            'browse_search-work',
            'add_message-people'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'search-people',
            ]);
        }

        

//____________________________________-________________________________


//############### BENEFICIARIO ######################

        // BENEFICIARIO
        $keys = [
            'browse_beneficiary-perfil-view',
            'edit_beneficiary-perfil-data'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'beneficiary-perfil-view',
            ]);
        }




        $keys = [
            'browse_message-beneficiary-bandeja'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'message-beneficiary-bandeja',
            ]);
        }


        $keys = [
            'browse_search-busine',
            'add_message-busine'
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => 'search-busine',
            ]);
        }
        
    }
}
