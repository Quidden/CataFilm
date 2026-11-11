<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tmdbGenreId' => $this->resource->tmdb_genre_id,
            'name' => $this->resource->name,
        ];
    }
}
