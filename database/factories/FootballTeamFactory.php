<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FootballTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'founded' => random_int(1857, 2030),
            'location' => $this->faker->city(),
            'stadium' => $this->faker->city(),
        ];
    }
}
