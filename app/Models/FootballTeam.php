<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballTeam extends Model
{
    use HasFactory;

    protected $table = 'football_teams';

    protected $fillable = [
        'name',
        'founded',
        'stadium',
        'location',
        'colour',
        'secondary_colour'
    ];

    public function players()
    {
        return $this->belongsToMany(FootballPlayer::class, 'football_players_to_teams')
            ->withPivot('start_date', 'end_date', 'transfer_type')
            ->withTimestamps();
    }
}

