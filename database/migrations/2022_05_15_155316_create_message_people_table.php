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
            $table->foreignId('people_experience_id')->nullable()->constrained('people_experiences');
            $table->foreignId('people_id')->nullable()->constrained('people');
            $table->foreignId('rubro_people_id')->nullable()->constrained('rubro_people');
            $table->foreignId('busine_id')->nullable()->constrained('busines');
            $table->foreignId('rubro_busine_id')->nullable()->constrained('rubro_busines');
            $table->string('imoney')->nullable();//porcio estimado
            $table->string('fmoney')->nullable();//precio estimado
            $table->text('detail')->nullable();
            $table->datetime('view')->nullable();
            $table->datetime('date_view')->nullable();
            $table->smallInteger('status')->default(2);

            //para la calificacion de la persona por sus servicios o trabajos
            $table->smallInteger('star')->default(0);
            $table->text('comment')->nullable();
            $table->date('star_date')->nullable();

            
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
