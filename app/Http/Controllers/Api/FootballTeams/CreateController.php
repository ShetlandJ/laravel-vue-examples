<?php

namespace App\Http\Controllers\Api\FootballTeams;

use App\Models\FootballTeam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $content = $request->all();

        $newTeam = FootballTeam::create($content);

        return response()->json($newTeam, Response::HTTP_OK);
    }
}
