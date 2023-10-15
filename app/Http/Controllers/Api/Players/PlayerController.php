<?php

namespace App\Http\Controllers\Api\Players;

use App\Models\FootballPlayer;
use App\Models\FootballTeam; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayerController extends \App\Http\Controllers\Controller

{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'dateOfBirth' => 'required|date',
            'country' => 'required|string',
            'team_id' => 'required|exists:football_teams,id',
            'transfer_type' => 'required|string', 
        ]);
    
        $player = FootballPlayer::create([
            'name' => $data['name'],
            'position' => $data['position'],
            'date_of_birth' => $data['dateOfBirth'],
            'country' => $data['country'],
        ]);

        $player->teams()->attach($data['team_id'], [
            'transfer_type' => $data['transfer_type'],
            'start_date' => now(),
        ]);

        return response()->json($player, Response::HTTP_OK);
    }
}

