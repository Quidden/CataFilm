<?php

namespace App\Annotations\Api;

/**
 * @OA\Info(
 *     title="CataFilm API",
 *     version="1.0.0",
 *     description="API documentation for the CataFilm movie catalog."
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="API server"
 * )
 *
 * @OA\Schema(
 *     schema="Genre",
 *     type="object",
 *     @OA\Property(property="tmdbGenreId", type="integer", example=28),
 *     @OA\Property(property="name", type="string", example="Action")
 * )
 *
 * @OA\Schema(
 *     schema="Movie",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tmdbId", type="integer", example=550),
 *     @OA\Property(property="title", type="string", example="Fight Club"),
 *     @OA\Property(property="originalTitle", type="string", example="Fight Club"),
 *     @OA\Property(property="overview", type="string", example="A ticking-time-bomb insomniac..."),
 *     @OA\Property(property="releaseDate", type="string", format="date", example="1999-10-15"),
 *     @OA\Property(property="runtimeMinutes", type="integer", example=139),
 *     @OA\Property(property="posterPath", type="string", example="/path/to/poster.jpg"),
 *     @OA\Property(property="voteAverage", type="number", format="float", example=8.4),
 *     @OA\Property(
 *         property="genres",
 *         type="object",
 *         @OA\Property(
 *             property="genres",
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Genre")
 *         )
 *     ),
 *     @OA\Property(property="reviewsCount", type="integer", example=42)
 * )
 */
class OpenApi
{
}
