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
        Schema::create('lesson_pdfs', function (Blueprint $table) {
            $table->id('pdf_id');
            $table->unsignedBigInteger('les_id');
            $table->string('pdf_file');
            $table->timestamps();

            $table->foreign('les_id')->references('les_id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_pdfs');
    }
};
