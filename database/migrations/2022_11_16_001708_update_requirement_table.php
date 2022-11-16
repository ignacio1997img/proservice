<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people_requirements', function (Blueprint $table) {
            $table->smallInteger('exp_camaraSeguridad')->nullable();// experiencia en camara de seguridad
            $table->smallInteger('exp_controlAcceso')->nullable();// experiencia en control de acceso
            $table->smallInteger('exp_cercoElectrico')->nullable();// experiencia en cerco electrico
            $table->smallInteger('exp_sistemaAlarma')->nullable();// experiencia en sistema de alarma
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
