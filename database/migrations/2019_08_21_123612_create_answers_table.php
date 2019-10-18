<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned();
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->string('icon')->nullable();
            $table->string('tag');
            $table->boolean('is_selected');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
