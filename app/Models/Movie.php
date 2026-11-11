<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'original_title',
        'overview',
        'release_date',
        'runtime_minutes',
        'poster_path',
        'tmdb_vote_average',
        'cached_until',
    ];


    protected $casts = [
        'release_date' => 'date',
        'cached_until' => 'datetime',
    ];

    public function isRefreshNeeded(): bool
    {
        return $this->cached_until === null || $this->cached_until->isPast();
    }

    public function findListEntryFor(User $user): ?UserMovieList
    {
        return $this->listEntries()
            ->where('user_id', $user->getKey())
            ->first();
    }

    public function scopeListLatestReleases(Builder $query, int $take, int $skip): Builder
    {
        return $query->latest('release_date')
            ->limit($take)
            ->offset($skip);
    }

    public function scopeFilterByGenre(Builder $query, string $genreName): Builder
    {
        return $query->whereHas('genres', fn (Builder $builder) =>
            $builder->where('name', $genreName)
        );
    }

    public function attachGenres(array $genres): void
    {
        foreach ($genres as $genre) {
            $model = Genre::firstOrCreate(
                ['tmdb_genre_id' => $genre['tmdb_genre_id']],
                ['name' => $genre['name']]
            );

            $this->genres()->syncWithoutDetaching($model);
        }
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function listEntries()
    {
        return $this->hasMany(UserMovieList::class);
    }

    public function collections()
    {
        return $this->belongsToMany(CustomCollection::class, 'collection_movie', 'movie_id', 'collection_id');
    }
}
