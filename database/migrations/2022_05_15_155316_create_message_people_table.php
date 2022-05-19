<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->nullable()->constrained('people');
            $table->foreignId('rubro_people_id')->nullable()->constrained('rubro_people');
            $table->foreignId('busine_id')->nullable()->constrained('busines');
            $table->foreignId('rubro_busine_id')->nullable()->constrained('rubro_busines');
            $table->text('detail')->nullable();
            $table->datetime('view')->nullable();
            $table->smallInteger('status')->default(2);
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
        Schema::dropIfExists('message_people');
    }
}
