<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    public function definition()
    {
        return [
            'tmdb_genre_id' => $this->faker->unique()->numberBetween(1, 100000),
            'name' => $this->faker->unique()->word(),
        ];
    }
}
