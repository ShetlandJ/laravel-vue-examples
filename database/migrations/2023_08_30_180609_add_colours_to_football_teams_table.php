<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoursToFootballTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('football_teams', function (Blueprint $table) {
            $table->string('colour')->nullable();          
            $table->string('secondary_colour')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('football_teams', function (Blueprint $table) {
            $table->dropColumn('colour');           
            $table->dropColumn('secondary_colour');
        });
    }
}

