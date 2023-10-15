<?php

namespace Database\Seeders;

use App\Models\FootballPlayer;
use App\Models\FootballTeam;
use Illuminate\Database\Seeder;

class SeedDefaultPlayers extends Seeder
{
    public function run()
    {
        $teamChelsea = FootballTeam::where('name', 'Chelsea')->first();
        $teamManUtd = FootballTeam::where('name', 'Manchester United')->first();

        $this->seedPlayerIfNotExist([
            'name' => 'Lionel Messi',
            'date_of_birth' => '1987-06-24',
            'position' => 'Forward',
            'country' => 'Argentina',
            'team' => $teamChelsea,
            'transfer_type' => 'Permanent'
        ]);

        $this->seedPlayerIfNotExist([
            'name' => 'Cristiano Ronaldo',
            'date_of_birth' => '1985-02-05',
            'position' => 'Forward',
            'country' => 'Portgual',
            'team' => $teamManUtd,
            'transfer_type' => 'Loan'
        ]);


        $this->seedPlayerIfNotExist([
            'name' => 'Roberto Firmino',
            'date_of_birth' => '1991-10-02',
            'position' => 'Forward',
            'country' => 'Brazil',
            'team' => FootballTeam::where('name', 'Liverpool')->first(),
            'transfer_type' => 'Loan'
        ]);

        $this->seedPlayerIfNotExist([
            'name' => 'Odsonne Edouard',
            'date_of_birth' => '1998-01-16',
            'position' => 'Forward',
            'country' => 'French',
            'team' => FootballTeam::where('name', 'Celtic')->first(),
            'transfer_type' => 'Permanent'
        ]);

        $this->seedPlayerIfNotExist([
            'name' => 'Alfredo Morelos',
            'date_of_birth' => '1996-06-21',
            'country' => 'Columbia',
            'position' => 'Forward',
            'team' => FootballTeam::where('name', 'Rangers')->first(),
            'transfer_type' => 'Loan'
        ]);

        $this->seedPlayerIfNotExist([
            'name' => 'Lawrence Shankland',
            'date_of_birth' => '1995-08-10',
            'position' => 'Forward',
            'country' => 'Scottish',
            'team' => FootballTeam::where('name', 'Dundee United')->first(),
            'transfer_type' => 'Permanent'
        ]);
    }

    public function seedPlayerIfNotExist(array $payload): void
    {
        $player = FootballPlayer::where('name', $payload['name'])->first();

        if (!$player) {
            $player = FootballPlayer::create([
                'name' => $payload['name'],
                'date_of_birth' => $payload['date_of_birth'],
                'position' => $payload['position'],
                'country' => $payload['country']
            ]);

            if (isset($payload['team'])) {
                $player->teams()->attach($payload['team']->id, [
                    'transfer_type' => 'transfer', 
                    'start_date' => now(),
                ]);
            }
        }
    }
}
