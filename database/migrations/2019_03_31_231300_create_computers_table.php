<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('lab_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('computers');
    }
}
