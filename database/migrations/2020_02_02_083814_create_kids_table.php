<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kindergarten_id')->index();
            $table->foreign('kindergarten_id')->references('id')
                ->on('kindergartens');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->boolean('is_present')->default(false);
            $table->string('first_name');
            $table->string('last_name');
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
        Schema::dropIfExists('kids');
    }
}
