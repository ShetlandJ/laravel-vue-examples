<?php

namespace Tests\Acceptance\Api\FootballTeams;

use Carbon\Carbon;
use App\Models\Org\User;
use App\Models\Org\Contract;
use App\Models\OneToOne\Topic;
use App\Models\OneToOne\OneToOne;
use Tests\Acceptance\AcceptanceTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateFootballTeamTest extends AcceptanceTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreatingFootballTeamSuccess()
    {
        $payload = [
            "name" => "asdf",
            "founded" => 2000,
            "stadium" => "asdf",
            "location" => "asdf"
        ];

        $response = $this->json('POST', '/api/teams', $payload);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreatingFootballTeamInvalidName()
    {
        $payload = [
            "name" => null,
            "founded" => 2000,
            "stadium" => "asdf",
            "location" => "asdf"
        ];

        $response = $this->json('POST', '/api/teams', $payload);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testCreatingFootballTeamInvalidFounded()
    {
        $payload = [
            "name" => "chelsea",
            "founded" => "asdf",
            "stadium" => "asdf",
            "location" => "asdf"
        ];

        $response = $this->json('POST', '/api/teams', $payload);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testCreatingFootballTeamInvalidStadium()
    {
        $payload = [
            "name" => "chelsea",
            "founded" => "asdf",
            "stadium" => 2000,
            "location" => "asdf"
        ];

        $response = $this->json('POST', '/api/teams', $payload);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testCreatingFootballTeamInvalidLocation()
    {
        $payload = [
            "name" => "chelsea",
            "founded" => "asdf",
            "stadium" => "asdf",
            "location" => 2000
        ];

        $response = $this->json('POST', '/api/teams', $payload);

        $this->assertEquals(422, $response->getStatusCode());
    }
}
