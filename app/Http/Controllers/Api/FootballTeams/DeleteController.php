<?php

namespace App\Http\Controllers\Api\FootballTeams;

use App\Models\FootballTeam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class DeleteController extends Controller
{
    public function __invoke(Request $request, FootballTeam $team)
    {
        $team->delete();

        return response()->json([
            'message' => 'Team deleted successfully',
        ], Response::HTTP_NO_CONTENT);
    }
}
