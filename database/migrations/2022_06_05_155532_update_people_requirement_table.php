<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePeopleRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people_requirements', function (Blueprint $table) {
            //idiomas
            $table->smallInteger('spanish')->nullable();
            $table->smallInteger('english')->nullable();
            $table->smallInteger('frances')->nullable();
            $table->smallInteger('italiano')->nullable();
            $table->smallInteger('portugues')->nullable();
            $table->smallInteger('aleman')->nullable();
            $table->string('otro_idioma', 500)->nullable();
            //piscinero
            $table->smallInteger('exp_mant_piscina')->nullable();// experiencia en mantenimiento de piscina
            $table->string('trabajado_ante_donde')->nullable();// donde ha trabajado ante como piscinero
            $table->smallInteger('medir_ph')->nullable();// saber medir ph
            $table->smallInteger('asp_piscina')->nullable();// saber aspirar piscina
            $table->smallInteger('cant_quimico')->nullable();// saber calacular Cantidad de quimico
            $table->smallInteger('bomba_agua')->nullable();// conocimiento de funciuonamiento de bomba de agua

            //modelo
            $table->string('image_book')->nullable();
            $table->text('curso_modelaje')->nullable();//curso de modelaje y otros relacionados
            $table->text('exp_modelaje')->nullable();//experiencia en modelaje
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people_requirements', function (Blueprint $table) {
        });
    }
}
