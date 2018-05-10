<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhrasePhraseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrase_phrase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phrase1_id')->unsigned();
            $table->integer('phrase2_id')->unsigned();
            $table->foreign('phrase1_id')->references('id')->on('phrases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('phrase2_id')->references('id')->on('phrases')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrase_phrase');
    }
}
