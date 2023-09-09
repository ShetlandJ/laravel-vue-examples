<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FootballPlayer extends Model
{
    protected $table = 'football_players';

    protected $fillable = [
        'name',
        'position',
        'date_of_birth', 
        'country',
    ];


    public function teams()
    {
        return $this->belongsToMany(FootballTeam::class, 'football_players_to_teams')
            ->withPivot('start_date', 'end_date', 'transfer_type')
            ->withTimestamps();
    }
}
