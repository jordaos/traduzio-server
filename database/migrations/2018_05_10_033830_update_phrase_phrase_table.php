<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePhrasePhraseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('phrase_phrase');
        Schema::create('phrase_phrase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phrase_id')->unsigned();
            $table->integer('phrase1_id')->unsigned();
            $table->foreign('phrase_id')->references('id')->on('phrases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('phrase1_id')->references('id')->on('phrases')->onUpdate('cascade')->onDelete('cascade');
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
        //
    }
}
