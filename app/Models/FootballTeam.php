<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FootballTeam extends Model
{
    protected $table = 'football_teams';

    protected $fillable = [
        'name',
        'founded',
        'stadium',
        'location'
    ];
}
