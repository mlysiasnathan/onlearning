<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id('res_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('les_id');
            $table->integer('score');
            $table->timestamps();

            $table->foreign('user_id')-references('user_id')->on('users');
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
        Schema::dropIfExists('results');
    }
};
