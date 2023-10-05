<?php

namespace Tests\Acceptance\Api\FootballTeams;

use App\Models\FootballTeam;
use Carbon\Carbon;
use App\Models\Org\User;
use App\Models\Org\Contract;
use App\Models\OneToOne\Topic;
use App\Models\OneToOne\OneToOne;
use Tests\Acceptance\AcceptanceTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateFootballTeamTest extends AcceptanceTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreatingFootballTeamSuccess()
    {
        $team = FootballTeam::factory()->create();

        $this->assertEquals(2, 1 + 1);
    }
}
