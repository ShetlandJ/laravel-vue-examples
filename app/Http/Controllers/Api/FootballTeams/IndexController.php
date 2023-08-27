<?php

namespace App\Http\Controllers\Api\FootballTeams;

use App\Models\FootballTeam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $allTeams = FootballTeam::all();

        return response()->json($allTeams, Response::HTTP_OK);
    }
}
