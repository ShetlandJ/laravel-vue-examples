<?php

namespace App\Http\Controllers\Api\FootballTeams;

use App\Models\FootballTeam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdateController extends Controller 
{
    public function __invoke(Request $request, FootballTeam $team)
    {
        $updatedData = $request->validate([
            'name' => 'required|string|max:255',
            'founded' => 'required|date',
            'stadium' => 'required|string|max:255',
            'location' => 'required|string|max:255',

        ]);

        $team->update($updatedData);

        return response()->json([
            'message' => 'Team updated successfully',
            'team' => $team,
        ], Response::HTTP_OK);
    }
}