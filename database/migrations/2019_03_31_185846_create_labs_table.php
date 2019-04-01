<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
            $table->time('opening_time');
            $table->time('closing_time');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labs');
    }
}
