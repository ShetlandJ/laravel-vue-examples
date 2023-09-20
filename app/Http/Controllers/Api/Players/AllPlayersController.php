<?php

namespace App\Http\Controllers\Api\FootballPlayers;

use App\Models\FootballPlayer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class AllPlayersController extends Controller
{
    public function __invoke(Request $request)
    {
        $allTeams = FootballPlayer::all();

        return response()->json($allTeams, Response::HTTP_OK);
    }
}
