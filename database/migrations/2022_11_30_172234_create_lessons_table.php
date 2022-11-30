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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id('les_id');
            $table->string('les_name');
            $table->unsignedBigInteger('cat_id');
            $table->integer('les_price');
            $table->string('les_img');
            $table->mediumText('les_content');
            $table->timestamps();

            $table->foreign('cat_id')->references('cat_id')->on('lesson_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};
