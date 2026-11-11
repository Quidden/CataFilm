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

    /**
     * @OA\Get(
     *     path="/api/movies",
     *     tags={"Movies"},
     *     summary="List movies, latest releases first",
     *     @OA\Parameter(
     *         name="genre",
     *         in="query",
     *         required=false,
     *         description="Filter by genre name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         description="Maximum number of movies to return",
     *         @OA\Schema(type="integer", minimum=0, default=20)
     *     ),
     *     @OA\Parameter(
     *         name="offset",
     *         in="query",
     *         required=false,
     *         description="Number of movies to skip",
     *         @OA\Schema(type="integer", minimum=0, default=0)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="movies",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Movie")
     *             ),
     *             @OA\Property(property="moviesCount", type="integer", example=1)
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/movies/{id}",
     *     tags={"Movies"},
     *     summary="Get a single movie by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="movie", ref="#/components/schemas/Movie")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     */
    public function getMovie(int $id)
    {
        $movie = Movie::withCount('reviews')
            ->with('genres')
            ->findOrFail($id);

        return new MovieResource($movie);
    }
}
