<?php

namespace App\Http\Controllers\Api\FootballTeams;

use App\Models\FootballTeam;
use App\Http\Controllers\Controller;
use Database\Seeders\SeedDefaultTeams;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class RefreshController extends Controller
{
    public function __invoke(Request $request)
    {
        (new SeedDefaultTeams())->run();

        return response()->json([
            'message' => 'Teams refreshed successfully',
        ], Response::HTTP_OK);
    }
}
