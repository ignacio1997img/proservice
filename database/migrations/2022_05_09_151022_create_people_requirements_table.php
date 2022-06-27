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
            $table->string('image_ci')->nullable(); //carnet de identidad anverso
            $table->string('image_ci2')->nullable(); //carta de identidad reverso
            $table->string('image_ap')->nullable();//antecedentes penales

            //idiomas
            $table->smallInteger('spanish')->nullable();
            $table->smallInteger('english')->nullable();
            $table->smallInteger('frances')->nullable();
            $table->smallInteger('italiano')->nullable();
            $table->smallInteger('portugues')->nullable();
            $table->smallInteger('aleman')->nullable();
            $table->string('otro_idioma', 500)->nullable();





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
