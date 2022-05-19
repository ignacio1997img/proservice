<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rubro_id')->nullable()->constrained('rubro_busines');
            $table->foreignId('user_id')->nullable()->constrained('users');            
            $table->string('nit')->unique();
            $table->string('name')->nullable();
            $table->string('responsible')->nullable();
            $table->text('address')->nullable();
            $table->string('image',600)->nullable();            
            $table->string('email')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('busines');
    }
}
