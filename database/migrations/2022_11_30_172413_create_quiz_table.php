<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.2
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->id('quiz_id');
            $table->unsignedBigInteger('les_id');
            $table->text('question');
            $table->text('correct_ans');
            $table->text('ans_1');
            $table->text('ans_2');
            $table->text('ans_3');
            $table->text('ans_4');
            $table->timestamps();

            $table->foreign('les_id')-references('les_id')->on('lessons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
};
