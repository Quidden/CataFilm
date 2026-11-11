<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public static $wrap = 'movie';

    public function toArray($request)
    {
        return [
            'id' => $this->resource->getKey(),
            'tmdbId' => $this->resource->tmdb_id,
            'title' => $this->resource->title,
            'originalTitle' => $this->resource->original_title,
            'overview' => $this->resource->overview,
            'releaseDate' => $this->resource->release_date,
            'runtimeMinutes' => $this->resource->runtime_minutes,
            'posterPath' => $this->resource->poster_path,
            'voteAverage' => $this->resource->tmdb_vote_average,
            'genres' => new GenresCollection($this->resource->genres),
            'reviewsCount' => $this->resource->reviews_count ?? $this->resource->reviews()->count(),
        ];
    }
}
