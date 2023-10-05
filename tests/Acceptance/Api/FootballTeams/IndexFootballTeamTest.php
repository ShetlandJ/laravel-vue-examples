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

class IndexFootballTeamTest extends AcceptanceTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreatingFootballTeamSuccess()
    {
        // $team = FootballTeam::factory()->create();

        // $this->assertEquals(2, 1 + 1);


        $response = $this->json('GET', '/api/teams');

        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content);

        $this->assertCount(6, $json);
    }
}
