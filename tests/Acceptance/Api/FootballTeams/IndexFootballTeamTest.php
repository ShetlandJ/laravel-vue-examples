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
        // $team = FootballTeam::factory()->create();
    }

    public function testGetTeams()
    {
        $response = $this->json('GET', '/api/teams');

        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content);

        $this->assertCount(6, $json);
    }

    public function testGetMoreTeams()
    {

        FootballTeam::factory()->count(2)->create();

        $response = $this->json('GET', '/api/teams');

        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content);

        $this->assertCount(8, $json);
    }
}
