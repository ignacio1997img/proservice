<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->foreignId('people_experience_id')->nullable()->constrained('people_experiences');
            $table->string('image_ci')->nullable(); //carta de identidad
            $table->string('image_ap')->nullable();//antecedentes penales

            //guardia            
            $table->string('image_lsm')->nullable();//libreta de servicio militar
            $table->string('image_fcc')->nullable();//foto de cuerpo completo
            $table->smallInteger('t_manana')->nullable();
            $table->smallInteger('t_tarde')->nullable();
            $table->smallInteger('t_dia')->nullable();
            $table->smallInteger('t_noche')->nullable();

            //jardinero
            $table->smallInteger('exp_jardineria')->nullable();
            $table->smallInteger('exp_paisajismo')->nullable();
            $table->text('exp_maquinas')->nullable();

            $table->string('estatura')->nullable();
            $table->string('peso')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_requirements');
    }
}
