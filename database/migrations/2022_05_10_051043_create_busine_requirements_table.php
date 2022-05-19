<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusineRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busine_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('busine_id')->nullable()->constrained('busines');
            $table->string('type')->nullable();
            $table->string('image_lf')->nullable(); //licencia de funcionamiento
            $table->string('image_roe')->nullable();

            //guardia
            $table->string('image_pd')->nullable(); //Permiso de denacev


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
        Schema::dropIfExists('busine_requirements');
    }
}
