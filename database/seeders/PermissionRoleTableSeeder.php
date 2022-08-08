<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permission_role')->delete();
        
        // Root
        $role = Role::where('name', 'admin')->firstOrFail();
        $permissions = Permission::all();
        $role->permissions()->sync($permissions->pluck('id')->all());


        //############## PEOPLE ######################
        $role = Role::where('name', 'trabajador')->firstOrFail();
        $permissions = Permission::whereRaw('table_name = "admin" or
                                            table_name = "people-perfil-experience" or
                                            table_name = "pasantes" or
                                            table_name = "message-people-bandeja" or
                                            `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());





        //############## BUSINESS ######################
        $role = Role::where('name', 'empresa')->firstOrFail();
        $permissions = Permission::whereRaw('table_name = "admin" or
                                            table_name = "busine-perfil-experience" or
                                            table_name = "message-busine-bandeja" or
                                            table_name = "search-people" or
                                            `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());




        //############## BENEFICIARIO ######################
        $role = Role::where('name', 'beneficiario')->firstOrFail();
        $permissions = Permission::whereRaw('table_name = "admin" or
                                            table_name = "beneficiary-perfil-view" or
                                            table_name = "message-beneficiary-bandeja" or
                                            table_name = "search-busine" or
                                            `key` = "browse_clear-cache"')->get();
        $role->permissions()->sync($permissions->pluck('id')->all());
    }



}
