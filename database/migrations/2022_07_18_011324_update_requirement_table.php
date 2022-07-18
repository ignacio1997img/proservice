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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('talla_sup')->nullable();
            $table->integer('talla_inf')->nullable();
            $table->integer('nro_calsado')->nullable();
            $table->smallInteger('exp_pasarela')->nullable();
            $table->smallInteger('exp_fotografia')->nullable();
            $table->smallInteger('exp_publicidad')->nullable();

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
