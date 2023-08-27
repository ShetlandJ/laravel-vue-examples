<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootballTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('football_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('founded');
            $table->string('stadium');
            $table->string('location');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('football_teams');
    }
}
