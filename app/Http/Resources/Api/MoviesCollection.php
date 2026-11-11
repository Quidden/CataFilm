<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @property \Illuminate\Support\Collection<\App\Models\Movie> $collection
 */
class MoviesCollection extends ResourceCollection
{
    public static $wrap = 'movies';

    public $collects = MovieResource::class;

    public function with($request)
    {
        return [
            'moviesCount' => $this->collection->count(),
        ];
    }
}
