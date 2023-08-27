<?php

use Database\Seeders\SeedDefaultTeams;
use Illuminate\Database\Migrations\Migration;

class RunSeederSeedDefaultTeams extends Migration
{
    public function up()
    {
        (new SeedDefaultTeams())->run();
    }
}
