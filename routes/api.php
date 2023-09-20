<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::namespace('App')->prefix('/teams')->group(function () {
//     Route::get('/', 'FootballTeamController')->name('api.football-team.index');
// });

use App\Http\Controllers\Api\Players\PlayerController;
use App\Http\Controllers\Api\Players\AllPlayersController;

Route::namespace('App\Http\Controllers\Api\FootballTeams')->prefix('/teams')->group(function () {
    Route::get('/refresh', 'RefreshController')->name('api.football-team.refresh');
    Route::get('/', 'IndexController')->name('api.football-team.index');
    Route::post('/', 'CreateController')->name('api.football-team.create');
    Route::delete('/{team:id}', 'DeleteController')->name('api.football-team.destroy');
    Route::put('/{team:id}', 'UpdateController')->name('api.football-team.update');
    Route::post('/add-player', [PlayerController::class, '__invoke'])->name('api.football-team.add-player');
    Route::get('/players', [AllPlayersController::class, '__invoke'])->name('api.football-team.players');

});
