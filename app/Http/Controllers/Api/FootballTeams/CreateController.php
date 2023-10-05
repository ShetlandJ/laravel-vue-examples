<?php

namespace App\Http\Controllers\Api\FootballTeams;

use App\Models\FootballTeam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $content = $request->all();

        $validator = Validator::make($content, [
            "name" => "required|string"
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $newTeam = FootballTeam::create($content);

        return response()->json($newTeam, Response::HTTP_OK);
    }
}
