<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use App\Models\UserMovieList;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMovieListFactory extends Factory
{
    public function definition()
    {
        $status = $this->faker->randomElement(UserMovieList::STATUSES);

        return [
            'user_id' => User::factory(),
            'movie_id' => Movie::factory(),
            'status' => $status,
            'rating' => $status === UserMovieList::STATUS_COMPLETED
                ? $this->faker->optional(80)->numberBetween(1, 10)
                : null,
            'rewatch_count' => $status === UserMovieList::STATUS_COMPLETED
                ? $this->faker->numberBetween(0, 3)
                : 0,
            'watched_at' => $status === UserMovieList::STATUS_COMPLETED
                ? $this->faker->dateTimeThisDecade()
                : null,
        ];
    }
}
