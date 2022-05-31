<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMessageBusineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_busines', function (Blueprint $table) {
            $table->smallInteger('star')->default(0);
            $table->text('comment')->nullable();
            $table->date('star_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_busines', function (Blueprint $table) {
            $table->dropColumn('star');
            $table->dropColumn('comment');
            $table->dropColumn('star_date');
        });
    }
}
