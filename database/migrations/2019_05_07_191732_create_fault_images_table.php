<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fault_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('path');
            $table->integer('fault_id')->unsigned();
            $table->foreign('fault_id')->references('id')->on('faults');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fault_images');
    }
}
