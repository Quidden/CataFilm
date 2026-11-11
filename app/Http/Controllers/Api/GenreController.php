<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\GenresCollection;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/genres",
     *     tags={"Genres"},
     *     summary="List all genres",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="genres",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Genre")
     *             )
     *         )
     *     )
     * )
     *
     * @return \App\Http\Resources\Api\GenresCollection<Genre>
     */
    public function getGenreList()
    {
        return new GenresCollection(Genre::all());
    }
}
