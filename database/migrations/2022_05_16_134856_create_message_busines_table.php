<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateMessageBusinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_busines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('busine_id')->nullable()->constrained('busines');
            $table->foreignId('rubro_busine_id')->nullable()->constrained('rubro_busines');
            $table->foreignId('beneficiary_id')->nullable()->constrained('beneficiaries');
            $table->text('detail')->nullable();
            $table->string('file')->nullable();
            $table->datetime('view')->nullable();
            $table->datetime('date_view')->nullable();

            $table->smallInteger('status')->default(2);

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
        Schema::dropIfExists('message_busines');
    }
}
