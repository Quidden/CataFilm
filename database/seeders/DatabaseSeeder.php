<?php

namespace Database\Seeders;

use App\Models\CustomCollection;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use App\Models\UserMovieList;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory()->count(20)->create();

        $genres = Genre::factory()->count(15)->create();

        $movies = Movie::factory()->count(40)->create();

        foreach ($movies as $movie) {
            $movie->genres()->attach($genres->random(rand(1, 4)));
        }

        foreach ($users as $user) {
            foreach ($movies->random(rand(3, 8)) as $movie) {
                UserMovieList::factory()->create([
                    'user_id' => $user->getKey(),
                    'movie_id' => $movie->getKey(),
                ]);
            }

            foreach ($movies->random(rand(1, 5)) as $movie) {
                Review::factory()->create([
                    'user_id' => $user->getKey(),
                    'movie_id' => $movie->getKey(),
                ]);
            }
        }

        /** @var array<CustomCollection>|\Illuminate\Database\Eloquent\Collection<CustomCollection> $collections */
        $collections = CustomCollection::factory()
            ->count(10)
            ->state(new Sequence(fn () => [
                'user_id' => $users->random(),
            ]))
            ->create();

        foreach ($collections as $collection) {
            $collection->movies()->attach($movies->random(rand(2, 8)));
        }
    }
}
