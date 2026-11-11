<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    public function definition()
    {
        return [
            'tmdb_id' => $this->faker->unique()->numberBetween(1, 1000000),
            'title' => $this->faker->unique()->sentence(3),
            'original_title' => $this->faker->optional()->sentence(3),
            'overview' => $this->faker->optional()->paragraph(),
            'release_date' => $this->faker->optional(90)->date(),
            'runtime_minutes' => $this->faker->optional(90)->numberBetween(60, 240),
            'poster_path' => $this->faker->optional()->imageUrl(),
            'tmdb_vote_average' => $this->faker->optional(90)->randomFloat(1, 0, 10),
            'cached_until' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
