<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'movie_id' => Movie::factory(),
            'content' => $this->faker->paragraph(),
            'contains_spoilers' => $this->faker->boolean(20),
        ];
    }
}
