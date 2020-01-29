<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIllnessKidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illness_kid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('illness_id')->index();
            $table->foreign('illness_id')->references('id')
                ->on('illnesses')
                ->onDelete('cascade');
            $table->unsignedBigInteger('kid_id')->index();
            $table->foreign('kid_id')->references('id')
                ->on('kids')
                ->onDelete('cascade');
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
        Schema::dropIfExists('illness_kid');
    }
}
