<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->nullable()->constrained('people');
            $table->foreignId('rubro_id')->nullable()->constrained('rubro_people');
            $table->foreignId('typeModel_id')->nullable()->constrained('type_models');//para cuando selecione modelo 

            $table->smallInteger('folio')->default(0);

            $table->smallInteger('status')->default(2);  // 1: activo, 2: pendiente 0: inactivo

            $table->integer('star')->default(0);
            $table->integer('cant')->default(0);

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
        Schema::dropIfExists('people_experiences');
    }
}
