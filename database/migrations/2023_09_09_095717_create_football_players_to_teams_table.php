<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootballPlayersToTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('football_players_to_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('transfer_type');
            $table->timestamps();
            
            $table->foreign('player_id')->references('id')->on('football_players')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('football_teams')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('football_players_to_teams');
    }
}

