<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootballPlayersTable extends Migration
{
    public function up()
    {
        Schema::create('football_players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->date('date_of_birth');
            $table->string('country');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('football_players');
    }
}

