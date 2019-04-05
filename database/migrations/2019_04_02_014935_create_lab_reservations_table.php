<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->bigInteger('lab_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->bigInteger('reserved_by')->unsigned();
            $table->dateTime('reserved_at')->nullable();
            $table->text('description')->nullable();
            $table->integer('reservable_id')->unsigned();
            $table->string('reservable_type')->nullable();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('reserved_by')->references('id')->on('users');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lab_reservations');
    }
}
