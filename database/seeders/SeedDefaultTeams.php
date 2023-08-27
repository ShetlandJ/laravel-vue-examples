<?php

namespace Database\Seeders;

use App\Models\FootballTeam;
use Illuminate\Database\Seeder;

class SeedDefaultTeams extends Seeder
{
    public function run()
    {
        $this->seedTeamIfNotExist([
            'name' => 'Chelsea',
            'founded' => '1905',
            'stadium' => 'Stamford Bridge',
            'location' => 'London'
        ]);

        $this->seedTeamIfNotExist([
            'name' => 'Manchester United',
            'founded' => '1878',
            'stadium' => 'Old Trafford',
            'location' => 'Manchester'
        ]);

        $this->seedTeamIfNotExist([
            'name' => 'Liverpool',
            'founded' => '1892',
            'stadium' => 'Arfield Arena',
            'location' => 'Liverpool'
        ]);

        $this->seedTeamIfNotExist([
            'name' => 'Celtic',
            'founded' => '1887',
            'stadium' => 'Celtic Park',
            'location' => 'Glasgow'
        ]);

        $this->seedTeamIfNotExist([
            'name' => 'Rangers',
            'founded' => '1872',
            'stadium' => 'Ibrox Stadium',
            'location' => 'Glasgow'
        ]);

        $this->seedTeamIfNotExist([
            'name' => 'Dundee United',
            'founded' => '1909',
            'stadium' => 'Tannadice Park',
            'location' => 'Dundee'
        ]);
    }

    public function seedTeamIfNotExist(array $payload): void
    {
        $team = FootballTeam::where('name', $payload['name'])->first();

        if (!$team) {
            FootballTeam::create($payload);
        }
    }
}
