<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\GenresCollection;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * @return \App\Http\Resources\Api\GenresCollection<Genre>
     */
    public function getGenreList()
    {
        return new GenresCollection(Genre::all());
    }
}
