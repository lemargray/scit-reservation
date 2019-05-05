<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faults', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('computer_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->bigInteger('logged_by')->unsigned();
            $table->dateTime('logged_at')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('actioned_by')->unsigned();
            $table->dateTime('actioned_at')->nullable();
            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('logged_by')->references('id')->on('users');
            $table->foreign('actioned_by')->references('id')->on('users');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faults');
    }
}
