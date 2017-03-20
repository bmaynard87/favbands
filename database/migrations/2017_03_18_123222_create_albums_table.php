<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('recorded_date')->nullable();
            $table->date('release_date')->nullable();
            $table->integer('number_of_tracks')->nullable();
            $table->string('label')->nullable();
            $table->string('producer')->nullable();
            $table->string('genre')->nullable();
            $table->timestamps();
            $table->integer('band_id')->unsigned();
            $table->foreign('band_id')->references('id')->on('bands')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
