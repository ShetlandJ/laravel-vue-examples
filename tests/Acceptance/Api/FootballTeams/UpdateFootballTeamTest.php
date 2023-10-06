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

        $newName = 'wrexham';

        $payload = [
            'name' => $newName,
            'founded' => $team->founded,
            'stadium' => $team->stadium,
            'location' => $team->location,
        ];

        // dd($payload["name"]);

        $response = $this->json('PUT', '/api/teams/' . $team->id,  $payload);

        $content = $response->getContent();

        $json = json_decode($content);

        $id = $json->team->id;

        $updatedName = $json->team->name;

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(2, 1 + 1);

        $this->assertEquals($id, $team->id);

        $this->assertEquals($newName, $updatedName);
    }
}
