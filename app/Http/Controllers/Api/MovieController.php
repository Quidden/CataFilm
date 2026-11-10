<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MovieListRequest;
use App\Http\Resources\Api\MovieResource;
use App\Http\Resources\Api\MoviesCollection;
use App\Models\Movie;

class MovieController extends Controller
{
    protected const FILTER_LIMIT = 20;

    protected const FILTER_OFFSET = 0;

    public function getMovieList(MovieListRequest $request)
    {
        $filter = collect($request->validated());

        $list = Movie::withCount('reviews')
            ->with('genres')
            ->listLatestReleases(
                (int) $filter->get('limit', static::FILTER_LIMIT),
                (int) $filter->get('offset', static::FILTER_OFFSET)
            );

        if ($genre = $filter->get('genre')) {
            $list->filterByGenre($genre);
        }

        return new MoviesCollection($list->get());
    }

    public function getMovie(int $id)
    {
        $movie = Movie::withCount('reviews')
            ->with('genres')
            ->findOrFail($id);

        return new MovieResource($movie);
    }
}
