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

class DeleteFootballTeamTest extends AcceptanceTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // $team = FootballTeam::factory()->create();
    }

    public function testDeleteTeamSuccess()
    {
        $payload = [
            "name" => "teamToDelete",
            "founded" => 2000,
            "stadium" => "asdf",
            "location" => "asdf"
        ];


        $createResponse = $this->json('POST', '/api/teams/', $payload);
        $this->assertEquals(200, $createResponse->getStatusCode());


        $createdTeamData = json_decode($createResponse->getContent());
        $teamId = $createdTeamData->id;

        $getAllResponse = $this->json('GET', '/api/teams');
        $this->assertEquals(200, $getAllResponse->getStatusCode());

        $teams = json_decode($getAllResponse->getContent());

        $teamExistsInList = false;
        foreach ($teams as $existingTeam) {
            if ($existingTeam->id == $teamId) {
                $teamExistsInList = true;
                break;
            }
        }

        $this->assertTrue($teamExistsInList, "Newly created team not found in the list");

        $deleteResponse = $this->json('DELETE', '/api/teams/' . $teamId);
        $this->assertEquals(204, $deleteResponse->getStatusCode());

        $getAllTeams = $this->json('GET', '/api/teams');
        $this->assertEquals(200, $getAllResponse->getStatusCode());

        $newTeams = json_decode($getAllTeams->getContent());

        $teamIsStillPresent = false;
        foreach ($newTeams as $existingTeam) {
            if ($existingTeam->name == "teamToDelete") {
                $teamIsStillPresent = true;
                break;
            }
        }

        $this->assertFalse($teamIsStillPresent, "Team 'teamToDelete' was still found in the list after it should have been deleted.");
    }


    // public function testGetMoreTeams()
    // 

    //     FootballTeam::factory()->count(2)->create();

    //     $response = $this->json('GET', '/api/teams');

    //     $this->assertEquals(200, $response->getStatusCode());

    //     $content = $response->getContent();

    //     $json = json_decode($content);

    //     $this->assertCount(8, $json);
    // }
}
