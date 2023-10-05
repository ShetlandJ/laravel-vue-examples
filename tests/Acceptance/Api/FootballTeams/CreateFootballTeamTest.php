<?php

namespace Tests\Acceptance\Api\OneToOne;

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
}
