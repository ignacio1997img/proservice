<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_people', function (Blueprint $table) {
            $table->string('imoney')->nullable();
            $table->string('fmoney')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_people', function (Blueprint $table) {
            $table->dropColumn('imoney');
            $table->dropColumn('fmoney');
        });
    }
}
