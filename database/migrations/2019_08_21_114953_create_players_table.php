<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('gender');
            $table->integer('age');
            $table->string('city');
            $table->string('mobile');
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
}
